<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStateFieldToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function(Blueprint $table) {
            $table->enum('status', ['pagada', 'sin pagar', 'parcialmente pagada', 'cancelada'])
                ->default('sin pagar')
                ->after('due_date');
            $table->text('terms')->nullable()->after('client_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function(Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('terms');
        });
    }
}
