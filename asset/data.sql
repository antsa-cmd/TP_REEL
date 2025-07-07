CREATE DATABASE GESTION;
USE GESTION;

-- Table employees
CREATE TABLE employees (
    emp_no      INT             NOT NULL,
    birth_date  DATE            NOT NULL,
    first_name  VARCHAR(14)     NOT NULL,
    last_name   VARCHAR(16)     NOT NULL,
    gender      ENUM ('M','F')  NOT NULL,    
    hire_date   DATE            NOT NULL,
    PRIMARY KEY (emp_no)
);

-- Table departments
CREATE TABLE departments (
    dept_no     CHAR(4)         NOT NULL,
    dept_name   VARCHAR(40)     NOT NULL,
    PRIMARY KEY (dept_no),
    UNIQUE  KEY (dept_name)
);

-- Table dept_manager
CREATE TABLE dept_manager (
   emp_no       INT             NOT NULL,
   dept_no      CHAR(4)         NOT NULL,
   from_date    DATE            NOT NULL,
   to_date      DATE            NOT NULL,
   FOREIGN KEY (emp_no)  REFERENCES employees (emp_no)    ON DELETE CASCADE,
   FOREIGN KEY (dept_no) REFERENCES departments (dept_no) ON DELETE CASCADE,
   PRIMARY KEY (emp_no,dept_no)
); 

-- Insertion des employés nécessaires pour dept_manager
INSERT INTO employees VALUES
(110022,'1960-01-01','Jean','Dupont','M','1985-01-01'),
(110039,'1962-03-05','Marie','Durand','F','1991-10-01'),
(110085,'1959-07-21','Ali','Rami','M','1985-01-01'),
(110114,'1963-08-09','Nina','Ando','F','1989-12-17'),
(110183,'1955-06-30','Lova','Rakoto','M','1985-01-01'),
(110228,'1960-12-12','Sarah','Raveloson','F','1992-03-21'),
(110303,'1958-09-19','Tom','Johnson','M','1985-01-01'),
(110344,'1962-10-25','Anna','Smith','F','1988-09-09'),
(110386,'1965-05-14','David','Lee','M','1992-08-02'),
(110420,'1966-07-22','Linda','Walker','F','1996-08-30'),
(110511,'1957-02-15','Paul','Andrian','M','1985-01-01'),
(110567,'1961-04-17','Sophie','Raharinirina','F','1992-04-25'),
(110725,'1959-03-03','Eric','Taylor','M','1985-01-01'),
(110765,'1960-11-10','Julie','Brown','F','1989-05-06'),
(110800,'1964-06-11','Kevin','Wilson','M','1991-09-12'),
(110854,'1965-09-18','Elisa','Thomas','F','1994-06-28'),
(111035,'1958-12-01','Chris','Martin','M','1985-01-01'),
(111133,'1962-01-20','Emma','Garcia','F','1991-03-07'),
(111400,'1957-08-08','Alex','White','M','1985-01-01'),
(111534,'1963-02-28','Nora','Evans','F','1991-04-08'),
(111692,'1956-06-06','Marc','Lewis','M','1985-01-01'),
(111784,'1961-10-14','Lina','Perez','F','1988-10-17'),
(111877,'1959-01-23','Dan','Lopez','M','1992-09-08'),
(111939,'1965-11-12','Sophie','Martin','F','1996-01-03');

-- Insertion des départements
INSERT INTO departments VALUES 
('d001','Marketing'),
('d002','Finance'),
('d003','Human Resources'),
('d004','Production'),
('d005','Development'),
('d006','Quality Management'),
('d007','Sales'),
('d008','Research'),
('d009','Customer Service');

-- Insertion des managers
INSERT INTO dept_manager VALUES 
(110022,'d001','1985-01-01','1991-10-01'),
(110039,'d001','1991-10-01','9999-01-01'),
(110085,'d002','1985-01-01','1989-12-17'),
(110114,'d002','1989-12-17','9999-01-01'),
(110183,'d003','1985-01-01','1992-03-21'),
(110228,'d003','1992-03-21','9999-01-01'),
(110303,'d004','1985-01-01','1988-09-09'),
(110344,'d004','1988-09-09','1992-08-02'),
(110386,'d004','1992-08-02','1996-08-30'),
(110420,'d004','1996-08-30','9999-01-01'),
(110511,'d005','1985-01-01','1992-04-25'),
(110567,'d005','1992-04-25','9999-01-01'),
(110725,'d006','1985-01-01','1989-05-06'),
(110765,'d006','1989-05-06','1991-09-12'),
(110800,'d006','1991-09-12','1994-06-28'),
(110854,'d006','1994-06-28','9999-01-01'),
(111035,'d007','1985-01-01','1991-03-07'),
(111133,'d007','1991-03-07','9999-01-01'),
(111400,'d008','1985-01-01','1991-04-08'),
(111534,'d008','1991-04-08','9999-01-01'),
(111692,'d009','1985-01-01','1988-10-17'),
(111784,'d009','1988-10-17','1992-09-08'),
(111877,'d009','1992-09-08','1996-01-03'),
(111939,'d009','1996-01-03','9999-01-01');



/*CREATE VIEW*/

SELECT * 
FROM employees E join dept_manager
ON emp_no join departments
on dept_no 