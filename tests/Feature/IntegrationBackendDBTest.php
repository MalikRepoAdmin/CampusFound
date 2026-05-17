<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\Komentar;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class IntegrationBackendDBTest extends TestCase
{
    use RefreshDatabase;

    protected User $user1;
    protected User $user2;
    protected Laporan $laporan;
    protected Komentar $komentar1;
    protected Komentar $komentar2;

    
    /**
     * Custom PK Test
     */
    public function test_verify_custom_pk_in_migration_match_the_model(): void
    {
        // 1. Array of all models that will be checked
        $modelsToCheck = [
            User::class,
            Laporan::class,
            Barang::class,
            Komentar::class,
        ];

        foreach ($modelsToCheck as $modelClass) {
            $model = new $modelClass;

            // 2. Get the table name and the primary key defined in the Models
            $tableName = $model->getTable();
            $modelDefinedKey = $model->getKeyName();

            // 3. Get the actual database schema for the table's index structure
            $indexes = Schema::getIndexes($tableName);

            // 4. Find column that is assigned as 'primary' index in the Schema
            $databasePrimaryKeyColumn = null;
            foreach ($indexes as $index) {
                if ($index['primary']) {
                    // Get the column array associated with the primary key index
                    $databasePrimaryKeyColumn = $index['columns'][0]; 
                    break;
                }
            }

            // 5. Assertions to verify that the primary key exist and match the Model
            $this->assertNotNull(
                $databasePrimaryKeyColumn, 
                "Table '{$tableName}' does not have a primary key configured in its migration."
            );

            $this->assertEquals(
                $databasePrimaryKeyColumn, 
                $modelDefinedKey, 
                "FAIL(Mismatch): The '{$modelClass}' model expects '{$modelDefinedKey}', but the database migration table '{$tableName}' created '{$databasePrimaryKeyColumn}'."
            );
        }
    }


    /**
     * Custom FK and Model relationships audit Test
     */ 
    public function test_verify_model_relationships_match_the_migration_fk_constraints(): void
    {
        // 1. Map models to the relationship methods 
        $relationshipsToAudit = [
            User::class => ['laporans', 'komentars'],
            Laporan::class => ['users', 'barangs', 'komentars'],
            Barang::class => ['laporans'],
            Komentar::class => ['users', 'laporans'],
        ];

        foreach ($relationshipsToAudit as $modelClass => $methods) {
            $model = new $modelClass;
            $parentTable = $model->getTable();

            foreach ($methods as $method) {
                // Ignore method if it doesn't exist yet to prevent fatal script runtime crashes
                if (!method_exists($model, $method)) {
                    continue; 
                }

                // 2. Resolve the relationship instance
                $relation = $model->$method();
                
                // 3. Inspect the model's backend configuration attributes dynamically
                $foreignKeyInModel = $relation->getForeignKeyName(); 
                $relatedTable = $relation->getRelated()->getTable();  

                // 4. Retrieve foreign keys from both tables to ensure a comprehensive cross-search
                $allForeignKeys = array_merge(
                    Schema::getForeignKeys($parentTable),
                    Schema::getForeignKeys($relatedTable)
                );

                // 5. Audit Engine: Safely validate database matches without missing array keys
                $isConstraintFound = false;

                foreach ($allForeignKeys as $fk) {
                    // Extract column names safely using null coalescing to prevent undefined key exceptions
                    $dbColumns = $fk['columns'] ?? [];

                    // Verify if the model's expected foreign key column exists within this database constraint
                    if (in_array($foreignKeyInModel, $dbColumns)) {
                        
                        // Ensure the physical constraint references either the parent table or the related table path
                        if ($fk['foreign_table'] === $parentTable || $fk['foreign_table'] === $relatedTable) {
                            $isConstraintFound = true;
                            break; // Match found! Break loop and continue to the next relationship method
                        }
                    }
                }

                // 6. Output explicit debugging context if a mismatch is caught
                $this->assertTrue(
                    $isConstraintFound,
                    "Integrity Failure: The relationship method '{$modelClass}::{$method}()' is configured to use the foreign key column '{$foreignKeyInModel}'. " .
                    "However, no physical database foreign key constraint exists linking this column between tables '{$parentTable}' and '{$relatedTable}'."
                );
            }
        }
    }
}
