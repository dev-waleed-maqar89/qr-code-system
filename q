[1mdiff --git a/database/factories/UserFactory.php b/database/factories/UserFactory.php[m
[1mindex 584104c..2466f6b 100644[m
[1m--- a/database/factories/UserFactory.php[m
[1m+++ b/database/factories/UserFactory.php[m
[36m@@ -37,8 +37,8 @@[m [mpublic function definition(): array[m
      */[m
     public function unverified(): static[m
     {[m
[31m-        return $this->state(fn (array $attributes) => [[m
[32m+[m[32m        return $this->state(fn(array $attributes) => [[m
             'email_verified_at' => null,[m
         ]);[m
     }[m
[31m-}[m
[32m+[m[32m}[m
\ No newline at end of file[m
[1mdiff --git a/database/seeders/DatabaseSeeder.php b/database/seeders/DatabaseSeeder.php[m
[1mindex d01a0ef..ee1d67b 100644[m
[1m--- a/database/seeders/DatabaseSeeder.php[m
[1m+++ b/database/seeders/DatabaseSeeder.php[m
[36m@@ -20,4 +20,4 @@[m [mpublic function run(): void[m
             'email' => 'test@example.com',[m
         ]);[m
     }[m
[31m-}[m
[32m+[m[32m}[m
\ No newline at end of file[m
