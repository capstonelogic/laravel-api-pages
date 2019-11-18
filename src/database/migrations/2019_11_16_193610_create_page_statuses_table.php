<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use CapstoneLogic\Pages\Model\Status;

class CreatePageStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tablePrefix = config('capstonelogic.pages.db_prefix');

        Schema::create($tablePrefix.'page_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->timestamps();
            $table->softDeletes();
        });


        $items = [
            'draft',
            'published',
            'inactive',
        ];
        foreach ($items as $item) {
            Status::create([
                'title' => $item
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tablePrefix = config('capstonelogic.pages.db_prefix');

        Schema::dropIfExists($tablePrefix.'page_statuses');
    }
}
