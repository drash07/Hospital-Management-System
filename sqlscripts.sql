CREATE DATABASE hospital;
USE hospital;

#drop table patients;
#drop table diagnosis;
#drop table raw_procedure_codes;
#drop table procedure_codes;


create table patients(
patient_id int primary key,
national_provider_id int ,
age int,
sex int,
admitting_diagnosis_code varchar(15) 
);

create table diagnosis(
patient_id int,
diagnosis_id int primary key,
length_of_stay int,
discharge_status int,
stay_indicator char,
bill_total_per_diem int,
total_charges int,
surgery_indicator int,
provider_city_name varchar(25),  
FOREIGN KEY (patient_id)
        REFERENCES patients (patient_id)
        ON DELETE SET NULL ON UPDATE CASCADE
);



create table procedure_codes(
procedure_id int primary key auto_increment,
patient_id int,
procedure_code int,
FOREIGN KEY (patient_id)
        REFERENCES patients (patient_id)
        ON DELETE SET NULL ON UPDATE CASCADE
);



create table raw_procedure_codes(
patient_id int,
procedure_id int primary key,
procedure_code_1 int,
procedure_code_2 int,
procedure_code_3 int,
procedure_code_4 int,
procedure_code_5 int,
procedure_code_6 int,
procedure_code_7 int,
procedure_code_8 int,
procedure_code_9 int,
procedure_code_10 int,
procedure_code_11 int,
procedure_code_12 int,
procedure_code_13 int,
procedure_code_14 int,
procedure_code_15 int,
procedure_code_16 int,
procedure_code_17 int,
procedure_code_18 int,
procedure_code_19 int,
procedure_code_20 int,
procedure_code_21 int,
procedure_code_22 int,
procedure_code_23 int,
procedure_code_24 int,
procedure_code_25 int,
FOREIGN KEY (patient_id)
        REFERENCES patients (patient_id)
        ON DELETE SET NULL ON UPDATE CASCADE
); 

#Load scripts


LOAD DATA LOCAL INFILE 'C:\\xampp\\htdocs\\Project\\patients.csv' 
INTO TABLE hospital.patients 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"' 
ESCAPED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 lines (PATIENT_ID,NATIONAL_PROVIDER_ID,AGE,SEX,ADMITTING_DIAGNOSIS_CODE);

select * from diagnosis;

LOAD DATA LOCAL INFILE 'C:\\xampp\\htdocs\\Project\\diagnosis.csv' 
INTO TABLE hospital.diagnosis 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"' 
ESCAPED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 lines (PATIENT_ID,DIAGNOSIS_ID,LENGTH_OF_STAY,DISCHARGE_STATUS,STAY_INDICATOR,BILL_TOTAL_PER_DIEM,TOTAL_CHARGES,SURGERY_INDICATOR,PROVIDER_CITY_NAME);

select * from procedure_codes;

LOAD DATA LOCAL INFILE 'C:\\xampp\\htdocs\\Project\\procedure_codes.csv' 
INTO TABLE hospital.raw_procedure_codes 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"' 
ESCAPED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 lines (PATIENT_ID,PROCEDURE_ID,PROCEDURE_CODE_1,PROCEDURE_CODE_2,PROCEDURE_CODE_3,PROCEDURE_CODE_4,PROCEDURE_CODE_5,PROCEDURE_CODE_6,PROCEDURE_CODE_7,PROCEDURE_CODE_8,PROCEDURE_CODE_9,PROCEDURE_CODE_10,PROCEDURE_CODE_11,PROCEDURE_CODE_12,PROCEDURE_CODE_13,PROCEDURE_CODE_14,PROCEDURE_CODE_15,PROCEDURE_CODE_16,PROCEDURE_CODE_17,PROCEDURE_CODE_18,PROCEDURE_CODE_19,PROCEDURE_CODE_20,PROCEDURE_CODE_21,PROCEDURE_CODE_22,PROCEDURE_CODE_23,PROCEDURE_CODE_24,PROCEDURE_CODE_25);


insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_1 from raw_procedure_codes
where procedure_code_1 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_2 from raw_procedure_codes
where procedure_code_2 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_3 from raw_procedure_codes
where procedure_code_3 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_4 from raw_procedure_codes
where procedure_code_4 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_5 from raw_procedure_codes
where procedure_code_5 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_6 from raw_procedure_codes
where procedure_code_6 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_7 from raw_procedure_codes
where procedure_code_7 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_8 from raw_procedure_codes
where procedure_code_8 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_9 from raw_procedure_codes
where procedure_code_9 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_10 from raw_procedure_codes
where procedure_code_10 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_11 from raw_procedure_codes
where procedure_code_11 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_12 from raw_procedure_codes
where procedure_code_12 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_13 from raw_procedure_codes
where procedure_code_13 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_14 from raw_procedure_codes
where procedure_code_14 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_15 from raw_procedure_codes
where procedure_code_15 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_16 from raw_procedure_codes
where procedure_code_16 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_17 from raw_procedure_codes
where procedure_code_17 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_18 from raw_procedure_codes
where procedure_code_18 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_19 from raw_procedure_codes
where procedure_code_19 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_20 from raw_procedure_codes
where procedure_code_20 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_21 from raw_procedure_codes
where procedure_code_21 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_22 from raw_procedure_codes
where procedure_code_22 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_23 from raw_procedure_codes
where procedure_code_23 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_24 from raw_procedure_codes
where procedure_code_24 !=0;

insert into procedure_codes 
(patient_id, procedure_code)
select patient_id, procedure_code_25 from raw_procedure_codes
where procedure_code_25 !=0;

