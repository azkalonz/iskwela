<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreReportsRecordView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
            CREATE OR REPLACE VIEW score_reports_record_view 
            AS
            select 
                a.class_id,
                a.user_id,
                a.first_name,
                a.last_name,
                sum(a.perfect_score) as perfect_score,
                sum(a.score) as achieved_score,
                a.activity_type,
                a.date_created 
            from
            (
                select 
                    c.id as class_id,
                    u.id as user_id,
                    u.first_name, u.last_name,
                    coalesce(sa.perfect_score,0) as perfect_score,
                    sum(coalesce(sar.score,0)) as score,
                    sa.activity_type,
                    ca.published_at as date_created
                from classes c
                inner join sections_students ss on ss.section_id = c.section_id 
                inner join users u on u.id = ss.user_id 
                left join class_activities ca on ca.class_id = c.id
                inner join student_activities sa on sa.id = ca.student_activity_id 
                left join student_activity_records sar on sar.activity_id = sa.id and sar.user_id = u.id
                group by 1,2,3,4,5,7,8, sar.batch
                
                UNION ALL
                
                select c.id as class_id,
                    u.id as user_id,
                    u.first_name, u.last_name,
                    coalesce(a.total_score,0) as perfect_score,
                    sum(coalesce(sas.score,0)) as score,
                    if(a.activity_type  = 1, 4, IF(a.activity_type = 2, 5, 0)) as activity_type,
                    a.available_from as date_created
                from classes c
                inner join sections_students ss2 on ss2.section_id = c.section_id 
                inner join users u on u.id = ss2.user_id
                left join assignments a  on a.class_id = c.id and a.published = 1
                left join student_activity_scores sas on sas.activity_id = a.id and sas.student_id = u.id
                group by 1,2,3,4,5,7,8
            
            )a
            group by 1,2,3,4,7,8
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_reports_record_view');
    }
}
