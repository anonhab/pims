#!/bin/bash

# Function to create a migration file with a timestamped name
create_migration() {
    local timestamp=$(date +%Y_%m_%d_%H%M%S)
    local migration_name=$1
    local migration_content=$2
    local file_name="database/migrations/${timestamp}_${migration_name}.php"

    echo "<?php" > "$file_name"
    echo "" >> "$file_name"
    echo "$migration_content" >> "$file_name"
    echo "Created migration: $file_name"
    sleep 1 # Add 1-second delay to ensure unique timestamps
}

# Migration for roles table (first, no dependencies)
create_migration "create_roles_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name', 50);
            \$table->text('description')->nullable();
            \$table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
"

# Migration for prisons table
create_migration "create_prisons_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrisonsTable extends Migration
{
    public function up()
    {
        Schema::create('prisons', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name', 100)->unique();
            \$table->text('location')->nullable();
            \$table->integer('capacity')->nullable();
            \$table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prisons');
    }
}
"

# Migration for accounts table
create_migration "create_accounts_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('accounts', function (Blueprint \$table) {
            \$table->id('user_id');
            \$table->string('username', 50)->unique();
            \$table->string('password', 255);
            \$table->foreignId('role_id')->nullable()->constrained()->onDelete('cascade');
            \$table->string('first_name', 50)->nullable();
            \$table->string('last_name', 50)->nullable();
            \$table->string('email', 100)->unique();
            \$table->text('user_image')->nullable();
            \$table->string('phone_number', 20)->nullable();
            \$table->date('dob')->nullable();
            \$table->enum('gender', ['male', 'female'])->nullable();
            \$table->text('address')->nullable();
            \$table->timestamps();
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            \$table->index('prison_id', 'fk_accounts_prison');
        });
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
"

# Migration for rooms table
create_migration "create_rooms_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint \$table) {
            \$table->id();
            \$table->string('room_number', 20);
            \$table->integer('capacity')->nullable();
            \$table->enum('type', ['cell', 'medical', 'security', 'training', 'visitor', 'isolation'])->nullable();
            \$table->enum('status', ['available', 'occupied', 'under_maintenance'])->nullable();
            \$table->timestamps();
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            \$table->index('prison_id', 'fk_prison_rooms');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
"

# Migration for prisoners table
create_migration "create_prisoners_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrisonersTable extends Migration
{
    public function up()
    {
        Schema::create('prisoners', function (Blueprint \$table) {
            \$table->id();
            \$table->string('first_name', 50)->nullable();
            \$table->string('middle_name', 50)->nullable();
            \$table->string('last_name', 50)->nullable();
            \$table->date('dob')->nullable();
            \$table->enum('gender', ['male', 'female'])->nullable();
            \$table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            \$table->text('crime_committed')->nullable();
            \$table->enum('status', ['active', 'released', 'transferred'])->nullable();
            \$table->date('time_serve_start')->nullable();
            \$table->text('time_serve_end')->nullable();
            \$table->text('address')->nullable();
            \$table->string('emergency_contact_name', 100)->nullable();
            \$table->string('emergency_contact_relation', 50)->nullable();
            \$table->string('emergency_contact_number', 20)->nullable();
            \$table->text('inmate_image')->nullable();
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            \$table->foreignId('room_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            \$table->date('release_date')->nullable();
            \$table->timestamps();
            \$table->index('room_id', 'fk_room');
            \$table->index('prison_id', 'fk_prisoners_prison');
        });
    }

    public function down()
    {
        Schema::dropIfExists('prisoners');
    }
}
"

# Migration for lawyers table
create_migration "create_lawyers_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawyersTable extends Migration
{
    public function up()
    {
        Schema::create('lawyers', function (Blueprint \$table) {
            \$table->id('lawyer_id');
            \$table->string('first_name', 100);
            \$table->string('last_name', 100);
            \$table->date('date_of_birth');
            \$table->string('contact_info', 255);
            \$table->string('email', 150)->unique();
            \$table->string('password', 255);
            \$table->string('law_firm', 255);
            \$table->string('license_number', 100)->unique();
            \$table->integer('cases_handled')->default(0);
            \$table->timestamps();
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            \$table->string('profile_image', 255)->nullable();
            \$table->index('prison_id', 'fk_lawyer_prisons');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lawyers');
    }
}
"

# Migration for visitors table
create_migration "create_visitors_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    public function up()
    {
        Schema::create('visitors', function (Blueprint \$table) {
            \$table->id();
            \$table->string('first_name', 50)->nullable();
            \$table->string('last_name', 50)->nullable();
            \$table->string('phone_number', 20)->nullable();
            \$table->string('relationship', 50)->nullable();
            \$table->text('address')->nullable();
            \$table->string('identification_number', 50)->nullable()->unique();
            \$table->string('email');
            \$table->string('password', 255);
            \$table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
"

# Migration for training_programs table
create_migration "create_training_programs_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingProgramsTable extends Migration
{
    public function up()
    {
        Schema::create('training_programs', function (Blueprint \$table) {
            \$table->id();
            \$table->string('title', 100)->nullable();
            \$table->text('description')->nullable();
            \$table->foreignId('created_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->timestamps();
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            \$table->index('created_by');
            \$table->index('prison_id', 'fk_training_programs_prison');
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_programs');
    }
}
"

# Migration for notifications table
create_migration "create_notifications_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint \$table) {
            \$table->id();
            \$table->integer('recipient_id')->nullable();
            \$table->enum('recipient_role', ['admin', 'doctor', 'officer', 'lawyer', 'prisoner', 'visitor', 'inspector', 'commissioner', 'security', 'system_admin', 'training_officer', 'discipline_officer']);
            \$table->integer('role_id')->default(0);
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            \$table->string('related_table', 50)->nullable();
            \$table->integer('related_id')->nullable();
            \$table->string('title', 255)->nullable();
            \$table->text('message')->nullable();
            \$table->boolean('is_read')->default(0);
            \$ escreveu->timestamps();
            \$table->index('prison_id', 'fk_notifications_prison_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
"

# Migration for activity_log table
create_migration "create_activity_log_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogTable extends Migration
{
    public function up()
    {
        Schema::create('activity_log', function (Blueprint \$table) {
            \$table->id();
            \$table->string('activity_type', 100)->comment('Type of activity (e.g., create_backup, assign_job, schedule_appointment)');
            \$table->string('table_name', 50)->comment('Name of the table affected (e.g., backups, job_assignments)');
            \$table->integer('record_id')->comment('ID of the affected record in the respective table');
            \$table->foreignId('user_id')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            \$table->foreignId('lawyer_id')->nullable()->constrained('lawyers', 'lawyer_id')->onDelete('cascade');
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            \$table->text('activity_details')->nullable()->comment('Additional details about the activity');
            \$table->timestamps();
            \$table->index('user_id');
            \$table->index('prisoner_id');
            \$table->index('lawyer_id');
            \$table->index('prison_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_log');
    }
}
"

# Migration for audits table
create_migration "create_audits_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    public function up()
    {
        Schema::create('audits', function (Blueprint \$table) {
            \$table->bigIncrements('id');
            \$table->string('user_type', 255)->nullable();
            \$table->bigInteger('device_id')->nullable();
            \$table->string('event', 255);
            \$table->string('auditable_type', 255);
            \$table->text('old_values')->nullable();
            \$table->text('new_values')->nullable();
            \$table->text('url')->nullable();
            \$table->string('ip_address', 45)->nullable();
            \$table->string('user_agent', 1023)->nullable();
            \$table->string('tags', 255)->nullable();
            \$table->timestamps();
            \$table->integer('auditable_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audits');
    }
}
"

# Migration for backups table
create_migration "create_backups_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackupsTable extends Migration
{
    public function up()
    {
        Schema::create('backups', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('initiated_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->datetime('backup_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            \$table->enum('backup_status', ['in_progress', 'completed', 'failed'])->nullable();
            \$table->timestamps();
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            \$table->index('initiated_by', 'fk_backups_user');
            \$table->index('prison_id', 'fk_backups_prison_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('backups');
    }
}
"

# Migration for certification_records table
create_migration "create_certification_records_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificationRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('certification_records', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            \$table->foreignId('issued_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->enum('certification_type', ['job_completion', 'training_program_completion'])->nullable();
            \$table->text('certification_details')->nullable();
            \$table->datetime('issued_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            \$table->enum('status', ['issued', 'revoked'])->nullable();
            \$table->timestamps();
            \$table->index('prisoner_id', 'fk_certification_records_prisoner');
            \$table->index('issued_by', 'fk_certification_records_issued_by');
        });
    }

    public function down()
    {
        Schema::dropIfExists('certification_records');
    }
}
"

# Migration for job_assignments table
create_migration "create_job_assignments_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::create('job_assignments', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            \$table->foreignId('assigned_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->string('job_title', 100)->nullable();
            \$table->text('job_description')->nullable();
            \$table->date('assigned_date')->nullable();
            \$table->date('end_date')->nullable();
            \$table->enum('status', ['active', 'completed', 'terminated'])->nullable();
            \$table->timestamps();
            \$table->index('prisoner_id', 'fk_job_assignments_prisoner');
            \$table->index('assigned_by', 'fk_job_assignments_assigned_by');
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_assignments');
    }
}
"

# Migration for lawyer_appointments table
create_migration "create_lawyer_appointments_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawyerAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('lawyer_appointments', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            \$table->foreignId('lawyer_id')->nullable()->constrained('lawyers', 'lawyer_id')->onDelete('cascade');
            \$table->datetime('appointment_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            \$table->enum('status', ['scheduled', 'completed', 'cancelled'])->nullable();
            \$table->text('notes')->nullable();
            \$table->timestamps();
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            \$table->index('prisoner_id', 'fk_lawyer_appointments_prisoner');
            \$table->index('lawyer_id', 'fk_lawyer_appointments_lawyer');
            \$table->index('prison_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lawyer_appointments');
    }
}
"

# Migration for lawyer_prisoner_assignment table
create_migration "create_lawyer_prisoner_assignment_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawyerPrisonerAssignmentTable extends Migration
{
    public function up()
    {
        Schema::create('lawyer_prisoner_assignment', function (Blueprint \$table) {
            \$table->id('assignment_id');
            \$table->foreignId('prisoner_id')->constrained()->onDelete('cascade');
            \$table->date('assignment_date');
            \$table->foreignId('assigned_by')->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->foreignId('lawyer_id')->constrained('lawyers', 'lawyer_id')->onDelete('cascade');
            \$table->timestamps();
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            \$table->index('prisoner_id');
            \$table->index('assigned_by');
            \$table->index('lawyer_id', 'fk_lawyer_prisoner');
            \$table->index('prison_id', 'fk_lawyer_assignment');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lawyer_prisoner_assignment');
    }
}
"

# Migration for medical_appointments table
create_migration "create_medical_appointments_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('medical_appointments', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            \$table->foreignId('doctor_id')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->datetime('appointment_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            \$table->text('diagnosis')->nullable();
            \$table->text('treatment')->nullable();
            \$table->enum('status', ['scheduled', 'completed', 'cancelled'])->nullable();
            \$table->foreignId('created_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->timestamps();
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            \$table->index('prisoner_id', 'fk_medical_appointments_prisoner');
            \$table->index('doctor_id', 'fk_medical_appointments_doctor');
            \$table->index('created_by', 'fk_medical_appointments_created_by');
            \$table->index('prison_id', 'fk_prisonformedical');
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_appointments');
    }
}
"

# Migration for medical_reports table
create_migration "create_medical_reports_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalReportsTable extends Migration
{
    public function up()
    {
        Schema::create('medical_reports', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            \$table->foreignId('doctor_id')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->text('diagnosis')->nullable();
            \$table->text('treatment')->nullable();
            \$table->text('medications')->nullable();
            \$table->datetime('report_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            \$table->timestamps();
            \$table->foreignId('appointment_id')->nullable()->constrained('medical_appointments')->onDelete('cascade')->onUpdate('cascade');
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            \$table->date('follow_up_date')->nullable();
            \$table->text('notes')->nullable();
            \$table->text('follow_up')->nullable();
            \$table->index('prisoner_id', 'fk_medical_reports_prisoner');
            \$table->index('doctor_id', 'fk_medical_reports_doctor');
            \$table->index('appointment_id', 'fk_appointment');
            \$table->index('prison_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_reports');
    }
}
"

# Migration for new_visiting_requests table
create_migration "create_new_visiting_requests_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewVisitingRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('new_visiting_requests', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('visitor_id')->nullable()->constrained()->onDelete('cascade');
            \$table->date('requested_date')->nullable();
            \$table->enum('status', ['pending', 'approved', 'rejected'])->nullable();
            \$table->foreignId('approved_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->timestamps();
            \$table->string('prisoner_firstname', 255)->nullable();
            \$table->string('prisoner_middlename', 255)->nullable();
            \$table->string('prisoner_lastname', 255)->nullable();
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            \$table->time('requested_time');
            \$table->text('note')->nullable();
            \$table->index('prison_id');
            \$table->index('approved_by', 'fk_approved_by');
            \$table->index('visitor_id', 'fk_visitor_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('new_visiting_requests');
    }
}
"

# Migration for police_prisoner_assignment table
create_migration "create_police_prisoner_assignment_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicePrisonerAssignmentTable extends Migration
{
    public function up()
    {
        Schema::create('police_prisoner_assignment', function (Blueprint \$table) {
            \$table->bigIncrements('assignment_id');
            \$table->foreignId('officer_id')->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->foreignId('prisoner_id')->constrained()->onDelete('cascade');
            \$table->foreignId('prison_id')->constrained()->onDelete('cascade');
            \$table->date('assignment_date');
            \$table->foreignId('assigned_by')->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->timestamps();
            \$table->index('officer_id');
            \$table->index('prisoner_id');
            \$table->index('assigned_by');
            \$table->index('prison_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('police_prisoner_assignment');
    }
}
"

# Migration for reports table
create_migration "create_reports_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('generated_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->text('content')->nullable();
            \$table->text('report_type');
            \$table->timestamps();
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            \$table->index('generated_by', 'fk_reports_generated_by');
            \$table->index('prison_id', 'fk_reports_prison_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
"

# Migration for requests table
create_migration "create_requests_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('requests', function (Blueprint \$table) {
            \$table->id();
            \$table->text('request_type')->nullable();
            \$table->enum('status', ['pending', 'approved', 'rejected', 'transferred'])->nullable();
            \$table->foreignId('approved_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->text('request_details')->nullable();
            \$table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            \$table->foreignId('lawyer_id')->nullable()->constrained('lawyers', 'lawyer_id')->onDelete('cascade');
            \$table->foreignId('user_id')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->text('evaluation')->nullable();
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            \$table->timestamps();
            \$table->index('prisoner_id', 'idx_prisoner_id');
            \$table->index('approved_by', 'fk_requests_approved_by');
            \$table->index('lawyer_id', 'fk_requests_lawyer');
            \$table->index('user_id', 'fk_requests_user');
            \$table->index('prison_id', 'fk_prison_id_for_request');
        });
    }

    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
"

# Migration for system_logs table
create_migration "create_system_logs_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemLogsTable extends Migration
{
    public function up()
    {
        Schema::create('system_logs', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('account_id')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->text('action')->nullable();
            \$table->enum('entity', ['account', 'prison', 'prisoner', 'report', 'backup', 'request', 'medical_report', 'certification_record'])->nullable();
            \$table->timestamps();
            \$table->index('account_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('system_logs');
    }
}
"

# Migration for training_assignments table
create_migration "create_training_assignments_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::create('training_assignments', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('prisoner_id')->nullable()->constrained()->onDelete('cascade');
            \$table->foreignId('training_id')->nullable()->constrained('training_programs')->onDelete('cascade');
            \$table->foreignId('assigned_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->date('assigned_date')->nullable();
            \$table->date('end_date')->nullable();
            \$table->enum('status', ['in_progress', 'completed'])->nullable();
            \$table->timestamps();
            \$table->index('prisoner_id');
            \$table->index('training_id');
            \$table->index('assigned_by');
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_assignments');
    }
}
"

# Migration for visiting_requests table
create_migration "create_visiting_requests_table" "
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitingRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('visiting_requests', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('visitor_id')->nullable()->constrained()->onDelete('cascade');
            \$table->date('requested_date')->nullable();
            \$table->enum('status', ['pending', 'approved', 'rejected'])->nullable();
            \$table->foreignId('approved_by')->nullable()->constrained('accounts', 'user_id')->onDelete('cascade');
            \$table->timestamps();
            \$table->string('prisoner_firstname', 255)->nullable();
            \$table->string('prisoner_middlename', 255)->nullable();
            \$table->string('prisoner_lastname', 255)->nullable();
            \$table->foreignId('prison_id')->nullable()->constrained()->onDelete('cascade');
            \$table->index('approved_by');
            \$table->index('prison_id', 'idx_prison_id');
            \$table->index('visitor_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('visiting_requests');
    }
}
"

echo "All migration files have been created."
echo "Run 'php artisan migrate' to apply the migrations."