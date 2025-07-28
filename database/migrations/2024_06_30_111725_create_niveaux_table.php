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
            $table->string('Specialité');
            $table->string('Descriptif_niv');
            $table->string('Nom_niv_ar');
            $table->string('Specialité_ar');
            $table->integer('moyenne_niv')->nullable();
            $table->integer('major_niv')->nullable();
            $table->Date('date_major')->nullable();
            $table->string('Descriptif_niv_ar');
            $table->integer('id_post')->nullable();
            $table->foreign('id_post')->references('id_post')->on('posts');


        });
        DB::table('niveaux')->insert([
       [
              "Specialité" => "Génie Logiciel"
            ,
            "Descriptif_niv"=>"",
            "Nom_niv" => "Master 2"
             ,
             "Specialité_ar" => "الهندسة البرمجية"
              ,"Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""
             
            ],

            [
              "Specialité" => "Systèmes d’Information",
            "Descriptif_niv"=>"",
              "Nom_niv" => "Master 2"
             ,
             "Specialité_ar" => "نظم المعلومات"
              , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""             
            ],

            [
              "Specialité" => "Réseaux et Systèmes",
            "Descriptif_niv"=>"",
              "Nom_niv" => "Master 2"
             ,
             "Specialité_ar" => "الشبكات والأنظمة"
              , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""             
            ],

            [
              "Specialité" => "Sécurité Informatique",
            "Descriptif_niv"=>"",
              "Nom_niv" => "Master 2"
             ,
             "Specialité_ar" => "أمن المعلومات"
              , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""             
            ],

            [
              "Specialité" => "Science des Données",
            "Descriptif_niv"=>"",
              "Nom_niv" => "Master 2"
             ,
             "Specialité_ar" => "علم البيانات"
              , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""             
            ],

            [
              "Specialité" => "Intelligence Artificielle",
            "Descriptif_niv"=>"",
              "Nom_niv" => "Master 2"
             ,
             "Specialité_ar" => "الذكاء الاصطناعي"
              , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""             
            ],

             [
          "Specialité" => "Économie Internationale",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "الاقتصاد الدولي"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Économie du Développement",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "اقتصاد التنمية"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Sciences Commerciales",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "العلوم التجارية"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Marketing",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "التسويق"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Commerce International",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "التجارة الدولية"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Comptabilité",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "المحاسبة"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Audit et Contrôle",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "التدقيق والرقابة"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Banque et Assurance",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "البنوك والتأمين"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Gestion",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "التسيير"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Gestion des Ressources Humaines",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "تسيير الموارد البشرية"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

                 [
          "Specialité" => "Droit Public",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "القانون العام"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Droit Privé",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "القانون الخاص"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Droit Pénal",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "القانون الجنائي"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Droit Administratif",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "القانون الإداري"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Droit des Affaires",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "قانون الأعمال"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Droit Constitutionnel",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "القانون الدستوري"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Relations Internationales",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "العلاقات الدولية"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],
   

          [
          "Specialité" => "Psychologie Clinique",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "علم النفس السريري"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Psychologie Sociale",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "علم النفس الاجتماعي"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Neuropsychologie",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "علم النفس العصبي"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Sociologie Générale",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "علم الاجتماع العام"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Sociologie du Travail",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "علم اجتماع العمل"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Sociologie de l’Éducation",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "علم اجتماع التربية"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Histoire Contemporaine",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "التاريخ المعاصر"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Anthropologie",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "الأنثروبولوجيا"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Philosophie",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "الفلسفة"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

        [
          "Specialité" => "Sciences de l'Éducation",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Master 2"
         ,
         "Specialité_ar" => "علوم التربية"
          , "Nom_niv_ar" => "ماستر 2"
              ,"Descriptif_niv_ar"=>""         
        ],

                [
          "Specialité" => "Langue et Littérature Arabe",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialité_ar" => "اللغة والأدب العربي"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialité" => "Linguistique Arabe",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialité_ar" => "اللسانيات العربية"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialité" => "Langue et Littérature Française",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialité_ar" => "اللغة والأدب الفرنسي"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialité" => "Linguistique Française",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialité_ar" => "اللسانيات الفرنسية"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialité" => "FLE (Français Langue Étrangère)",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialité_ar" => "الفرنسية كلغة أجنبية (FLE)"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialité" => "Langue et Littérature Anglaise",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialité_ar" => "اللغة والأدب الإنجليزي"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialité" => "Linguistique Anglaise",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialité_ar" => "اللسانيات الإنجليزية"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialité" => "Traduction",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialité_ar" => "الترجمة"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialité" => "Langue Espagnole",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialité_ar" => "اللغة الإسبانية"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        ],

        [
          "Specialité" => "Langue Allemande",
        "Descriptif_niv"=>"",
          "Nom_niv" => "Licence"

         ,
         "Specialité_ar" => "اللغة الألمانية"
          , "Nom_niv_ar" => "ليسانس"

              ,"Descriptif_niv_ar"=>""        
            ],


                    [
          "Specialité" => "Maintenance Industrielle",
         "Nom_niv" => "BTS / TS",
         "Descriptif_niv_ar"=>"",
         "Descriptif_niv"=>"",
         "Specialité_ar" => "الصيانة الصناعية"
          , "Nom_niv_ar" => "تقني سام",
           
         
        ],

        [
          "Specialité" => "Réseaux Informatiques",
         "Nom_niv" => "BTS / TS"
         ,
         "Specialité_ar" => "الشبكات المعلوماتية"
          , "Nom_niv_ar" => "تقني سام",
         "Descriptif_niv_ar"=>"",
         "Descriptif_niv"=>"",
        ],

        [
          "Specialité" => "Topographie",
         "Nom_niv" => "BTS / TS"
         ,
         "Specialité_ar" => "الطبوغرافيا"
          , "Nom_niv_ar" => "تقني سام",
         "Descriptif_niv_ar"=>"",
         "Descriptif_niv"=>"",
        ],

        [
          "Specialité" => "Électromécanique",
         "Nom_niv" => "BTS / TS"
         ,
         "Specialité_ar" => "الإلكتروميكانيك"
          , "Nom_niv_ar" => "تقني سام",
         "Descriptif_niv_ar"=>"",
         "Descriptif_niv"=>"",
        ],

        [
          "Specialité" => "Froid et Climatisation",
         "Nom_niv" => "BTS / TS"
         ,
         "Specialité_ar" => "التبريد والتكييف"
          , "Nom_niv_ar" => "تقني سام",
         "Descriptif_niv_ar"=>"",
         "Descriptif_niv"=>"",
        ],

        [
          "Specialité" => "Sécurité et Hygiène Industrielle",
         "Nom_niv" => "BTS / TS"
         ,
         "Specialité_ar" => "السلامة والنظافة الصناعية"
          , "Nom_niv_ar" => "تقني سام",
         "Descriptif_niv_ar"=>"",
         "Descriptif_niv"=>"",
        ],

        [
          "Specialité" => "Dessin de Bâtiment",
         "Nom_niv" => "BTS / TS"
         ,
         "Specialité_ar" => "رسم البناء"
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
