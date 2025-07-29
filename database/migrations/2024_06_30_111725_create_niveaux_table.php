<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('niveaux', function (Blueprint $table) {
            $table->integer('id_niv')->primary()->autoIncrement();
            $table->string('Nom_niv');
            $table->string('Specialite
');
            $table->string('Descriptif_niv');
            $table->string('Nom_niv_ar');
            $table->string('Specialite
_ar');
            $table->integer('moyenne_niv')->nullable();
            $table->integer('major_niv')->nullable();
            $table->Date('date_major')->nullable();
            $table->string('Descriptif_niv_ar');
            $table->integer('id_post')->nullable();
            $table->foreign('id_post')->references('id_post')->on('posts');


        });
        DB::table('niveaux')->insert([
       [
              "Specialite
" => "Génie Logiciel"
            ,
            "Descriptif_niv"=>"",
            "Nom_niv" => "Master 2"
             ,
             "Specialite
_ar" => "الهندسة البرمجية"
              ,"Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""
             
            ],

            [
              "Specialite
" => "Systèmes d’Information",
            "Descriptif_niv"=>"",
              "Nom_niv" => "Master 2"
             ,
             "Specialite
_ar" => "نظم المعلومات"
              , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""             
            ],

            [
              "Specialite
" => "Réseaux et Systèmes",
            "Descriptif_niv"=>"",
              "Nom_niv" => "Master 2"
             ,
             "Specialite
_ar" => "الشبكات والأنظمة"
              , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""             
            ],

            [
              "Specialite
" => "Sécurité Informatique",
            "Descriptif_niv"=>"",
              "Nom_niv" => "Master 2"
             ,
             "Specialite
_ar" => "أمن المعلومات"
              , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""             
            ],

            [
              "Specialite
" => "Science des Données",
            "Descriptif_niv"=>"",
              "Nom_niv" => "Master 2"
             ,
             "Specialite
_ar" => "علم البيانات"
              , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""             
            ],

            [
              "Specialite
" => "Intelligence Artificielle",
            "Descriptif_niv"=>"",
              "Nom_niv" => "Master 2"
             ,
             "Specialite
_ar" => "الذكاء الاصطناعي"
              , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""             
            ],

             [
          "Specialite
" => "Économie Internationale",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "الاقتصاد الدولي"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Économie du Développement",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "اقتصاد التنمية"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Sciences Commerciales",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "العلوم التجارية"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Marketing",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "التسويق"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Commerce International",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "التجارة الدولية"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Comptabilité",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "المحاسبة"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Audit et Contrôle",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "التدقيق والرقابة"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Banque et Assurance",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "البنوك والتأمين"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Gestion",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "التسيير"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Gestion des Ressources Humaines",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "تسيير الموارد البشرية"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

                 [
          "Specialite
" => "Droit Public",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "القانون العام"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Droit Privé",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "القانون الخاص"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Droit Pénal",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "القانون الجنائي"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Droit Administratif",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "القانون الإداري"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Droit des Affaires",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "قانون الأعمال"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Droit Constitutionnel",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "القانون الدستوري"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Relations Internationales",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "العلاقات الدولية"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],
   

          [
          "Specialite
" => "Psychologie Clinique",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "علم النفس السريري"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Psychologie Sociale",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "علم النفس الاجتماعي"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Neuropsychologie",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "علم النفس العصبي"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Sociologie Générale",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "علم الاجتماع العام"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Sociologie du Travail",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "علم اجتماع العمل"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Sociologie de l’Éducation",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "علم اجتماع التربية"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Histoire Contemporaine",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "التاريخ المعاصر"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Anthropologie",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "الأنثروبولوجيا"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Philosophie",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "الفلسفة"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialite
" => "Sciences de l'Éducation",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialite
_ar" => "علوم التربية"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

                [
          "Specialite
" => "Langue et Littérature Arabe",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialite
_ar" => "اللغة والأدب العربي"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialite
" => "Linguistique Arabe",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialite
_ar" => "اللسانيات العربية"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialite
" => "Langue et Littérature Française",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialite
_ar" => "اللغة والأدب الفرنسي"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialite
" => "Linguistique Française",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialite
_ar" => "اللسانيات الفرنسية"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialite
" => "FLE (Français Langue Étrangère)",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialite
_ar" => "الفرنسية كلغة أجنبية (FLE)"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialite
" => "Langue et Littérature Anglaise",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialite
_ar" => "اللغة والأدب الإنجليزي"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialite
" => "Linguistique Anglaise",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialite
_ar" => "اللسانيات الإنجليزية"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialite
" => "Traduction",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialite
_ar" => "الترجمة"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialite
" => "Langue Espagnole",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialite
_ar" => "اللغة الإسبانية"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialite
" => "Langue Allemande",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialite
_ar" => "اللغة الألمانية"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        
            ],


                    [
          "Specialite
" => "Maintenance Industrielle",
         "Nom_niv" => "BTS / TS",
         "Descriptif_niv_ar"=>"",
         "Descriptif_niv"=>"",
         "Specialite
_ar" => "الصيانة الصناعية"
          , "Nom_niv_ar" => "تقني سام",
           
         
        ],

        [
          "Specialite
" => "Réseaux Informatiques",
         "Nom_niv" => "BTS / TS"
         ,
         "Specialite
_ar" => "الشبكات المعلوماتية"
          , "Nom_niv_ar" => "تقني سام",
         "Descriptif_niv_ar"=>"",
         "Descriptif_niv"=>"",
        ],

        [
          "Specialite
" => "Topographie",
         "Nom_niv" => "BTS / TS"
         ,
         "Specialite
_ar" => "الطبوغرافيا"
          , "Nom_niv_ar" => "تقني سام",
         "Descriptif_niv_ar"=>"",
         "Descriptif_niv"=>"",
        ],

        [
          "Specialite
" => "Électromécanique",
         "Nom_niv" => "BTS / TS"
         ,
         "Specialite
_ar" => "الإلكتروميكانيك"
          , "Nom_niv_ar" => "تقني سام",
         "Descriptif_niv_ar"=>"",
         "Descriptif_niv"=>"",
        ],

        [
          "Specialite
" => "Froid et Climatisation",
         "Nom_niv" => "BTS / TS"
         ,
         "Specialite
_ar" => "التبريد والتكييف"
          , "Nom_niv_ar" => "تقني سام",
         "Descriptif_niv_ar"=>"",
         "Descriptif_niv"=>"",
        ],

        [
          "Specialite
" => "Sécurité et Hygiène Industrielle",
         "Nom_niv" => "BTS / TS"
         ,
         "Specialite
_ar" => "السلامة والنظافة الصناعية"
          , "Nom_niv_ar" => "تقني سام",
         "Descriptif_niv_ar"=>"",
         "Descriptif_niv"=>"",
        ],

        [
          "Specialite
" => "Dessin de Bâtiment",
         "Nom_niv" => "BTS / TS"
         ,
         "Specialite
_ar" => "رسم البناء"
          , "Nom_niv_ar" => "تقني سام",
         "Descriptif_niv_ar"=>"",
         "Descriptif_niv"=>"",
        ],

        ]);
    }

   
   
   
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveaux');
    }
};
