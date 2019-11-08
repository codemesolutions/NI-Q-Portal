<?php

use Illuminate\Database\Seeder;
use App\FormPageLayout;

class FormPageLayoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fpl = new FormPageLayout();
        $fpl->name = 'One Column';
        $fpl->icon = "
            <div style='border: #999 3px dashed; padding: 2rem 1.25rem;'>
            
            </div>
        ";
        $fpl->markup = "
        <div class='form-page-1-column'>

        </div>";
        $fpl->save();

        $fpl = new FormPageLayout();
        $fpl->name = 'Two Columns';
        $fpl->icon = "
            <div class='row m-0'>
                <div style='border: #999 3px dashed; border-right:none; padding: 2rem 1rem;' class='col'>
                
                </div>
                <div style='border: #999 3px dashed; padding:2rem 1rem;' class='col'>
            
                </div>
            </div>
           
        ";
        $fpl->markup = "
        <div class='form-page-2-columns'>

        </div>";
        $fpl->save();


        $fpl = new FormPageLayout();
        $fpl->name = 'Three Columns';
        $fpl->icon = "
            <div class='row m-0'>
                <div style='border: #999 3px dashed; border-right:none; padding: 2rem 1rem;' class='col'>
                
                </div>
                <div style='border: #999 3px dashed; border-right:none; padding:2rem 1rem;' class='col'>
            
                </div>
                <div style='border: #999 3px dashed; padding:2rem 1rem;' class='col'>
            
                </div>
            </div>
           
        ";
        $fpl->markup = "
        <div class='form-page-3-columns'>

        </div>";
        $fpl->save();

        
        $fpl = new FormPageLayout();
        $fpl->name = 'Four Columns';
        $fpl->icon = "
            <div class='row m-0'>
                <div style='border: #999 3px dashed; border-right:none; padding: 2rem 1rem;' class='col'>
                
                </div>
                <div style='border: #999 3px dashed; border-right:none; padding:2rem 1rem;' class='col'>
            
                </div>
                <div style='border: #999 3px dashed; border-right:none; padding:2rem 1rem;' class='col'>
            
                </div>
                <div style='border: #999 3px dashed; padding:2rem 1rem;' class='col'>
            
                </div>
            </div>
           
        ";

        $fpl->markup = "
            <div class='form-page-4-columns'>

            </div>";

        $fpl->save();

   
    }
}
