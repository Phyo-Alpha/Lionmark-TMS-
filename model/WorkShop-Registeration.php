<?php

require_once __DIR__ . '/Model.php';

use phpformbuilder\database\DB;

enum Vaccinated: string
{
    case Yes = 'Yes';
    case No = 'No';
}

enum Status: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Cancelled = 'cancelled';
}

class WorkShopRegistration extends BaseModel
{
    protected static string $table = 'workshop_registrations';

    public ?int $id = null;
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $countryCode = '';
    public string $phone = '';
    public string $dob = '';
    public string $nationality = '';
    public string $address = '';
    public string $qualification = '';
    public string $englishCompetency = '';
    public Vaccinated $vaccinated = Vaccinated::No;
    public string $workshop = '';
    public string $classStartDate = '';
    public string $salesperson = '';
    public string $hearAboutUs = '';
    public ?string $registrationDate = null;
    public Status $status = Status::Pending;
    public string $notes = '';

    public static function find(int $id): ?static
    {
        $db = new DB();

        $result = $db->selectRow(
            from: static::$table,
            values: ["*"],
            where: [
                'id' => $id
            ]
        );

        if (!$result) {
            error_log("No record found for id: $id");
            return null;
        }

        return static::mapToObject($result);
    }

    public static function findAll(): array
    {
        $db = new DB();

        $results = $db->select(
            from: static::$table,
        );

        return array_map(function (array $result): static {
            return static::mapToObject($result);
        }, $results ?? []);
    }

    public static function create(array $data): int|false
    {
        $db = new DB();

        try {
            $success = $db->insert(
                table: static::$table,
                values: $data
            );

            if (!$success) {
                error_log("Failed to create record: " . json_encode($data));
                return false;
            }

            // Get the last inserted ID
            $lastId = $db->getLastInsertId();

            return $lastId !== false ? (int)$lastId : false;
        } catch (\Exception $e) {
            error_log("Exception creating record: " . $e->getMessage());
            return false;
        }
    }

    public static function update(int $id, array $data): bool
    {
        $db = new DB();

        $success = $db->update(
            table: static::$table,
            values: $data,
            where: [
                'id' => $id
            ]
        );

        if (!$success) {
            error_log("Failed to update record: " . json_encode($data));
            return false;
        }

        return true;
    }

    public static function delete(int $id): bool
    {
        $db = new DB();

        try {
            $success = $db->delete(
                from: static::$table,
                where: [
                    'id' => $id
                ]
            );

            if (!$success) {
                error_log("Failed to delete record: " . json_encode($id));
                return false;
            }

            return true;
        } catch (\Exception $e) {
            error_log("Exception deleting record: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Save the current instance (create or update)
     */
    public function save(): int|bool
    {
        $data = $this->toArray();

        // Remove id and registrationDate from insert data
        unset($data['id']);
        unset($data['registrationDate']);

        if ($this->id === null) {
            // Create new record
            $insertedId = static::create($data);
            if ($insertedId !== false) {
                $this->id = $insertedId;
                return $insertedId;
            }
            return false;
        } else {
            // Update existing record
            return static::update($this->id, $data);
        }
    }

    /**
     * Convert model to array (enums are converted to their string values)
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'countryCode' => $this->countryCode,
            'phone' => $this->phone,
            'dob' => $this->dob,
            'nationality' => $this->nationality,
            'address' => $this->address,
            'qualification' => $this->qualification,
            'englishCompetency' => $this->englishCompetency,
            'vaccinated' => $this->vaccinated->value, // Convert enum to string
            'workshop' => $this->workshop,
            'classStartDate' => $this->classStartDate,
            'salesperson' => $this->salesperson,
            'hearAboutUs' => $this->hearAboutUs,
            'registrationDate' => $this->registrationDate,
            'status' => $this->status->value, // Convert enum to string
            'notes' => $this->notes,
        ];
    }

    /**
     * Set attributes from array (mass assignment)
     */
    public function fill(array $data): static
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key) && $key !== 'id') {
                // Handle enum conversion
                if ($key === 'vaccinated' && !$value instanceof Vaccinated) {
                    $this->vaccinated = match ($value) {
                        'Yes' => Vaccinated::Yes,
                        'No' => Vaccinated::No,
                        default => Vaccinated::No
                    };
                } elseif ($key === 'status' && !$value instanceof Status) {
                    $this->status = match ($value) {
                        'pending', 'Pending' => Status::Pending,
                        'confirmed', 'Confirmed' => Status::Confirmed,
                        'cancelled', 'Cancelled' => Status::Cancelled,
                        default => Status::Pending
                    };
                } else {
                    $this->$key = $value ?? '';
                }
            }
        }
        return $this;
    }
}
