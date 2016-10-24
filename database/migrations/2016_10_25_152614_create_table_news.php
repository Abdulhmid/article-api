<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNews extends Migration
{
    protected $table = 'news';
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
                $table->string('title', 255)->nullable();
                $table->string('slug', 255)->nullable();
                $table->string('tag', 255)->nullable();
                $table->text('image')->nullable();
                $table->text('meta_title')->nullable();
                $table->text('meta_keyword')->nullable();
                $table->text('meta_description')->nullable();
                $table->text('content')->nullable();
                $table->integer('user_id')->unsigned();
                $table->tinyInteger('status')->default(0);
                $table->string('created_by')->default('system')->nullable();

                /* Action */
                $table->timestamps();

                /* Relations */
                $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('cascade')->onUpdate('cascade');

                
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
