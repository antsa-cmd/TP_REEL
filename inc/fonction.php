<?php
require('connexion.php');
function getDepartmentsWithManager() {
    $db = dbconnect();

    $sql = sprintf("
        SELECT d.dept_no, d.dept_name, e.first_name, e.last_name
        FROM departments d
        LEFT JOIN dept_manager dm ON d.dept_no = dm.dept_no
        LEFT JOIN employees e ON dm.emp_no = e.emp_no
        WHERE dm.to_date = '9999-01-01'
    ");

    $result = mysqli_query($db, $sql);
    if (!$result) {
        die("Erreur SQL : " . mysqli_error($db));
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getEmployeesOfDepartment($dept_no) {
    $db = dbconnect();

    $sql = sprintf("
        SELECT e.emp_no, e.first_name, e.last_name, e.hire_date
        FROM employees e
        JOIN dept_manager dm ON e.emp_no = dm.emp_no
        WHERE dm.dept_no = '%s' AND dm.to_date = '9999-01-01'
    ", mysqli_real_escape_string($db, $dept_no));

    $result = mysqli_query($db, $sql);
    if (!$result) {
        die("Erreur SQL : " . mysqli_error($db));
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getDepartmentName($dept_no) {
    $db = dbconnect();

    $sql = sprintf("
        SELECT dept_name
        FROM departments
        WHERE dept_no = '%s'
    ", mysqli_real_escape_string($db, $dept_no));

    $result = mysqli_query($db, $sql);
    if (!$result) {
        die("Erreur SQL : " . mysqli_error($db));
    }

    $row = mysqli_fetch_assoc($result);
    return $row['dept_name'] ?? 'Département inconnu';
}

