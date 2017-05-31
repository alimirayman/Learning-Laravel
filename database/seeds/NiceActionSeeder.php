<?php

use Illuminate\Database\Seeder;
use App\NiceAction;
use App\Category;

class NiceActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_1 = new Category();
        $category_1->name = 'Cat 1';
        $category_1->save();

        $category_2 = new Category();
        $category_2->name = 'Cat 2';
        $category_2->save();

        $nice_action = new NiceAction();
        $nice_action->name = 'Greet';
        $nice_action->niceness = 3;
        $nice_action->save();

        $category_1->nice_actions()->attach($nice_action);
        $category_2->nice_actions()->attach($nice_action);
    		
		$nice_action = new NiceAction();
        $nice_action->name = 'Hug';
        $nice_action->niceness = 6;
        $nice_action->save();

        $category_1->nice_actions()->attach($nice_action);

        $nice_action = new NiceAction();
        $nice_action->name = 'Kiss';
        $nice_action->niceness = 12;
        $nice_action->save();

        $category_2->nice_actions()->attach($nice_action);

        $nice_action = new NiceAction();
        $nice_action->name = 'Wave';
        $nice_action->niceness = 2;
        $nice_action->save();
    
        $category_2->nice_actions()->attach($nice_action);
        $category_1->nice_actions()->attach($nice_action);
    }
}
