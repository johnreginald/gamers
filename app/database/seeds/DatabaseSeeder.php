<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();

        $this->call('PostsTableSeeder');
        $this->command->info("Posts table seeded :)");

        $this->call('AccountsTableSeeder');
        $this->command->info("Accounts table seeded :)");

        $this->call('ProductsTableSeeder');
        $this->command->info("Products table seeded :)");

        $this->call('OrdersTableSeeder');
        $this->command->info("Products table seeded :)");

        $this->call('PostCategoriesTableSeeder');
        $this->command->info("Products Categories table seeded :)");

        // $this->call('ProductCategoriesTableSeeder');
        // $this->command->info("Products Categories table seeded :)");        
    }

}
