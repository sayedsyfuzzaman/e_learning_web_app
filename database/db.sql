CREATE SCHEMA elearning_webapp;

CREATE TABLE elearning_webapp.admin_info ( 
	id                   varchar(20)  NOT NULL    PRIMARY KEY,
	password             varchar(8)  NOT NULL    ,
	name                 varchar(100)  NOT NULL    ,
	email                text  NOT NULL    ,
	phone                varchar(20)      ,
	nationality          varchar(20)  NOT NULL    ,
	nid                  varchar(20)  NOT NULL    ,
	dob                  varchar(10)      ,
	gender               varchar(6)      ,
	address              text      ,
	image                text      ,
	created_at           datetime  NOT NULL    
 );

CREATE TABLE elearning_webapp.history ( 
	serial               int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	comment_one          text  NOT NULL    ,
	comment_two          text      ,
	comment_three        text      ,
	comment_four         text      ,
	`date`               datetime  NOT NULL    
 );

CREATE TABLE elearning_webapp.instructor_info ( 
	id                   varchar(20)  NOT NULL    PRIMARY KEY,
	password             varchar(8)  NOT NULL    ,
	name                 varchar(100)  NOT NULL    ,
	email                text  NOT NULL    ,
	dob                  varchar(10)      ,
	gender               varchar(6)      ,
	image                text      ,
	job_title            varchar(100)  NOT NULL    ,
	field                varchar(100)  NOT NULL    ,
	balance              decimal(15,2)  NOT NULL DEFAULT 0.00   ,
	created_at           datetime  NOT NULL    
 );

CREATE TABLE elearning_webapp.learner_info ( 
	id                   varchar(20)  NOT NULL    PRIMARY KEY,
	password             varchar(8)  NOT NULL    ,
	name                 varchar(100)  NOT NULL    ,
	highest_degree       text      ,
	email                text  NOT NULL    ,
	dob                  varchar(10)      ,
	gender               varchar(6)      ,
	image                text      ,
	created_at           datetime  NOT NULL    
 );

CREATE TABLE elearning_webapp.manager_info ( 
	id                   varchar(20)  NOT NULL    PRIMARY KEY,
	password             varchar(8)  NOT NULL    ,
	name                 varchar(100)  NOT NULL    ,
	email                text  NOT NULL    ,
	phone                varchar(20)      ,
	nationality          varchar(20)  NOT NULL    ,
	nid                  varchar(20)  NOT NULL    ,
	dob                  varchar(10)      ,
	gender               varchar(6)      ,
	address              text      ,
	image                text      ,
	salary               decimal(15,2)  NOT NULL DEFAULT 0.00   ,
	created_at           datetime  NOT NULL    
 );

CREATE TABLE elearning_webapp.salary_statement ( 
	id                   varchar(50)  NOT NULL    PRIMARY KEY,
	account_type         varchar(20)  NOT NULL    ,
	current_salary_scale decimal(15,2)   DEFAULT 0.00   ,
	prev_balance         decimal(15,2)   DEFAULT 0.00   ,
	paid_balance         decimal(15,2)   DEFAULT 0.00   ,
	balance              decimal(15,2)   DEFAULT 0.00   ,
	year                 varchar(4)  NOT NULL    ,
	month                varchar(15)  NOT NULL    ,
	payment_date         datetime  NOT NULL    ,
	paid_by              varchar(50)  NOT NULL    
 );

CREATE TABLE elearning_webapp.users ( 
	serial               int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	id                   varchar(50)  NOT NULL    ,
	usertype             varchar(20)  NOT NULL    
 );

CREATE TABLE elearning_webapp.course_info ( 
	course_id            varchar(20)  NOT NULL    PRIMARY KEY,
	course_name          varchar(100)  NOT NULL    ,
	thumbnail            text  NOT NULL    ,
	created_by           varchar(20)  NOT NULL    ,
	created_at           datetime  NOT NULL    ,
	price                decimal(15,2)      ,
	discount             int   DEFAULT 0   ,
	avilability          varchar(20)      
 );

CREATE INDEX fk_course_info_admin_info ON elearning_webapp.course_info ( created_by );

CREATE TABLE elearning_webapp.course_instructors ( 
	course_id            varchar(20)  NOT NULL    ,
	instructor_id        varchar(20)  NOT NULL    ,
	assigned_by          varchar(20)  NOT NULL    ,
	assiged_at           datetime  NOT NULL    
 );

CREATE INDEX fk_course_instructors ON elearning_webapp.course_instructors ( course_id );

CREATE INDEX fk_course_instructors_assigned ON elearning_webapp.course_instructors ( assigned_by );

CREATE INDEX fk_course_instructors_info ON elearning_webapp.course_instructors ( instructor_id );

CREATE TABLE elearning_webapp.course_material ( 
	material_id          varchar(20)  NOT NULL    PRIMARY KEY,
	title                varchar(100)  NOT NULL    ,
	file                 text      ,
	video_file           text      ,
	created_by           varchar(20)  NOT NULL    ,
	created_at           datetime  NOT NULL    ,
	course_id            varchar(20)  NOT NULL    
 );

CREATE INDEX fk_course_material ON elearning_webapp.course_material ( created_by );

CREATE INDEX fk_course_material_course_info ON elearning_webapp.course_material ( course_id );

CREATE TABLE elearning_webapp.course_progression ( 
	learner_id           varchar(20)  NOT NULL    ,
	material_id          varchar(20)  NOT NULL    ,
	`status`             varchar(10)  NOT NULL    
 );

CREATE INDEX fk_course_progression ON elearning_webapp.course_progression ( learner_id );

CREATE INDEX fk_course_progression_material ON elearning_webapp.course_progression ( material_id );

CREATE TABLE elearning_webapp.course_quiz ( 
	quiz_id              varchar(20)  NOT NULL    PRIMARY KEY,
	material_id          varchar(20)  NOT NULL    ,
	title                varchar(100)  NOT NULL    ,
	file                 text      ,
	created_by           varchar(20)  NOT NULL    ,
	created_at           datetime  NOT NULL    ,
	course_id            varchar(20)  NOT NULL    
 );

CREATE INDEX fk_course_quiz_course_info ON elearning_webapp.course_quiz ( course_id );

CREATE INDEX fk_course_quiz_course_material ON elearning_webapp.course_quiz ( material_id );

CREATE INDEX fk_course_quiz_instructor_info ON elearning_webapp.course_quiz ( created_by );

CREATE TABLE elearning_webapp.enrolled_course ( 
	learner_id           varchar(20)  NOT NULL    ,
	course_id            varchar(20)  NOT NULL    ,
	enrolled_at          datetime  NOT NULL    ,
	course_price         decimal(15,2)  NOT NULL    
 );

CREATE INDEX fk_enrolled_course ON elearning_webapp.enrolled_course ( learner_id );

CREATE INDEX fk_enrolled_course_course_info ON elearning_webapp.enrolled_course ( course_id );

CREATE TABLE elearning_webapp.taken_quiz ( 
	quiz_id              varchar(20)  NOT NULL    ,
	learner_id           varchar(20)  NOT NULL    ,
	material_id          varchar(20)  NOT NULL    ,
	submitted_at         datetime  NOT NULL    ,
	result               decimal(5,2)      
 );

CREATE INDEX fk_taken_quiz_course_info ON elearning_webapp.taken_quiz ( material_id );

CREATE INDEX fk_taken_quiz_course_quiz ON elearning_webapp.taken_quiz ( quiz_id );

CREATE INDEX fk_taken_quiz_learner_info ON elearning_webapp.taken_quiz ( learner_id );

CREATE TABLE elearning_webapp.course_community ( 
	topics_id            varchar(20)  NOT NULL    PRIMARY KEY,
	course_id            varchar(20)  NOT NULL    ,
	topic                text  NOT NULL    ,
	created_by           varchar(20)  NOT NULL    ,
	created_at           datetime  NOT NULL    
 );

CREATE INDEX fk_course_community ON elearning_webapp.course_community ( course_id );

CREATE INDEX fk_course_community_created ON elearning_webapp.course_community ( created_by );

CREATE TABLE elearning_webapp.community_topics_and_solutions ( 
	topics_id            varchar(20)  NOT NULL    ,
	solution             text  NOT NULL    ,
	posted_by            varchar(20)  NOT NULL    ,
	posted_at            datetime  NOT NULL    
 );

CREATE INDEX fk_community_topics_and_solutions ON elearning_webapp.community_topics_and_solutions ( topics_id );

CREATE INDEX fk_community_topics_and_solutions_posted ON elearning_webapp.community_topics_and_solutions ( posted_by );

ALTER TABLE elearning_webapp.community_topics_and_solutions ADD CONSTRAINT fk_community_topics_and_solutions FOREIGN KEY ( topics_id ) REFERENCES elearning_webapp.course_community( topics_id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.community_topics_and_solutions ADD CONSTRAINT fk_community_topics_and_solutions_posted FOREIGN KEY ( posted_by ) REFERENCES elearning_webapp.instructor_info( id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.course_community ADD CONSTRAINT fk_course_community FOREIGN KEY ( course_id ) REFERENCES elearning_webapp.course_info( course_id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.course_community ADD CONSTRAINT fk_course_community_created FOREIGN KEY ( created_by ) REFERENCES elearning_webapp.learner_info( id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.course_info ADD CONSTRAINT fk_course_info_admin_info FOREIGN KEY ( created_by ) REFERENCES elearning_webapp.manager_info( id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.course_instructors ADD CONSTRAINT fk_course_instructors FOREIGN KEY ( course_id ) REFERENCES elearning_webapp.course_info( course_id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.course_instructors ADD CONSTRAINT fk_course_instructors_info FOREIGN KEY ( instructor_id ) REFERENCES elearning_webapp.instructor_info( id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.course_instructors ADD CONSTRAINT fk_course_instructors_assigned FOREIGN KEY ( assigned_by ) REFERENCES elearning_webapp.manager_info( id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.course_material ADD CONSTRAINT fk_course_material_course_info FOREIGN KEY ( course_id ) REFERENCES elearning_webapp.course_info( course_id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.course_material ADD CONSTRAINT fk_course_material FOREIGN KEY ( created_by ) REFERENCES elearning_webapp.instructor_info( id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.course_progression ADD CONSTRAINT fk_course_progression_material FOREIGN KEY ( material_id ) REFERENCES elearning_webapp.course_material( material_id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.course_progression ADD CONSTRAINT fk_course_progression FOREIGN KEY ( learner_id ) REFERENCES elearning_webapp.learner_info( id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.course_quiz ADD CONSTRAINT fk_course_quiz_course_info FOREIGN KEY ( course_id ) REFERENCES elearning_webapp.course_info( course_id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.course_quiz ADD CONSTRAINT fk_course_quiz_course_material FOREIGN KEY ( material_id ) REFERENCES elearning_webapp.course_material( material_id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.course_quiz ADD CONSTRAINT fk_course_quiz_instructor_info FOREIGN KEY ( created_by ) REFERENCES elearning_webapp.instructor_info( id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.enrolled_course ADD CONSTRAINT fk_enrolled_course_course_info FOREIGN KEY ( course_id ) REFERENCES elearning_webapp.course_info( course_id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.enrolled_course ADD CONSTRAINT fk_enrolled_course FOREIGN KEY ( learner_id ) REFERENCES elearning_webapp.learner_info( id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.salary_statement ADD CONSTRAINT fk_salary_statement FOREIGN KEY ( id ) REFERENCES elearning_webapp.instructor_info( id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.salary_statement ADD CONSTRAINT fk_salary_statement1 FOREIGN KEY ( id ) REFERENCES elearning_webapp.manager_info( id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.taken_quiz ADD CONSTRAINT fk_taken_quiz_course_quiz FOREIGN KEY ( quiz_id ) REFERENCES elearning_webapp.course_quiz( quiz_id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.taken_quiz ADD CONSTRAINT fk_taken_quiz_learner_info FOREIGN KEY ( learner_id ) REFERENCES elearning_webapp.learner_info( id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE elearning_webapp.taken_quiz ADD CONSTRAINT fk_taken_quiz_course_info FOREIGN KEY ( material_id ) REFERENCES elearning_webapp.course_material( material_id ) ON DELETE RESTRICT ON UPDATE RESTRICT;

