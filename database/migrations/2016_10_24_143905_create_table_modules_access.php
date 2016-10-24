<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableModulesAccess extends Migration
{
    protected $table = "modules_access";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->table)) {
            Schema::create($this->table, function (Blueprint $table) {

                $table->engine = 'InnoDB';
                /** Primary key  */
                $table->increments('id');

                /** Main data  */
                $table->text('access_data');
                
                /** Foreign Key */
                $table->integer('group_id')->unsigned();
                $table->foreign('group_id')->references('group_id')->on('groups')
                        ->onDelete('cascade')->onUpdate('cascade');
                
                $table->integer('module_id')->unsigned();
                $table->foreign('module_id')->references('module_id')->on('modules')
                        ->onDelete('cascade')->onUpdate('cascade');

                /** Action */
                $table->nullableTimestamps();

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
