<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainerSkillCompetencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_skill_competences', function (Blueprint $table) {
            $table->id();
            //trainer info
            $table->integer('trainer_id');
            $table->string('trainer_name');
            $table->string('training_category');
            //evaluator info
            $table->integer('evaluator_id');
            $table->string('evaluator_name');
            $table->string('evaluation_date');
            //competence check
            //delivery the trainer
            $table->string('delivery_skills_rating_q1');
            $table->string('delivery_skills_rating_q2');
            $table->string('delivery_skills_rating_q3');
            $table->string('delivery_skills_rating_q4');
            $table->string('delivery_skills_rating_q5');
            $table->string('delivery_skills_rating_q6');
            $table->string('delivery_skills_rating_q7');
            $table->string('visual_aids_skills_rating_q1');
            $table->string('visual_aids_skills_rating_q2');
            $table->string('visual_aids_skills_rating_q3');
            $table->string('visual_aids_skills_rating_q4');
            $table->string('visual_aids_skills_rating_q5');
            $table->string('visual_aids_skills_rating_q6');
            $table->string('body_language_skills_rating_q1');
            $table->string('body_language_skills_rating_q2');
            $table->string('body_language_skills_rating_q3');
            $table->string('audience_participation_skills_rating_q1');
            $table->string('audience_participation_skills_rating_q2');
            $table->string('audience_participation_skills_rating_q3');
            $table->string('audience_participation_skills_rating_q4');
            $table->string('audience_participation_skills_rating_q5');
            $table->string('technical_competence_skills_rating_q1');
            $table->string('technical_competence_skills_rating_q2');
            $table->string('technical_competence_skills_rating_q3');
            $table->string('technical_competence_skills_rating_q4');
            $table->string('topics_trainer_lacks_knowledge_expertise')->nullable();
            $table->string('ways_trainer_can_connect_with_audience_q1')->nullable();
            $table->string('ways_trainer_can_connect_with_audience_q2')->nullable();
            $table->string('ways_trainer_can_connect_with_audience_q3')->nullable();
            $table->string('ways_trainer_can_connect_with_audience_q4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainer_skill_competences');
    }
}
