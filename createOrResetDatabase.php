<?php

  try {
    require_once "src/database/connection.php";
    $connection = new Connection();
    $pdo = $connection->getConnection();

    $pdo->exec("DROP TABLE `administrators`");
    $pdo->exec("DROP TABLE `employees`");
    $pdo->exec("DROP TABLE `users`");
    $pdo->exec("DROP TABLE `attendances`");
    $pdo->exec("DROP TABLE `patients`");

    $pdo->query("CREATE TABLE IF NOT EXISTS users(login VARCHAR (100), password VARCHAR (100), name VARCHAR(100), CONSTRAINT user_pk PRIMARY KEY (login))");
    $pdo->query("CREATE TABLE IF NOT EXISTS administrators(login VARCHAR (100), CONSTRAINT administrators_pk PRIMARY KEY (login), CONSTRAINT administrators_fk FOREIGN KEY (login) REFERENCES users (login))");
    $pdo->query("CREATE TABLE IF NOT EXISTS employees(login VARCHAR (100), CONSTRAINT employees_pk PRIMARY KEY (login), CONSTRAINT employees_fk FOREIGN KEY (login) REFERENCES users (login))");
    $pdo->query("CREATE TABLE IF NOT EXISTS patients(cpf VARCHAR(14), name VARCHAR(100), birthday DATE, gender VARCHAR(9), address VARCHAR(100), symptoms VARCHAR(500), severity VARCHAR(5), companion VARCHAR(100), startDate DATE, CONSTRAINT patients_pk PRIMARY KEY (cpf))");
    $pdo->query("CREATE TABLE IF NOT EXISTS attendances(patient_cpf VARCHAR(14), attendance_date DATE, attendance_time TIME, CONSTRAINT attendances_pk PRIMARY KEY (patient_cpf, attendance_date), CONSTRAINT attendances_fk FOREIGN KEY (patient_cpf) REFERENCES patients(cpf))");

    $pdo->query("INSERT INTO `users` (`name`, `login`, `password`) VALUES ('Carlos', 'admin', '202cb962ac59075b964b07152d234b70')");
    $pdo->query("INSERT INTO `administrators` VALUES ('admin')");
    $pdo->query("INSERT INTO `patients` (`cpf`, `name`, `birthday`, `gender`, `address`, `symptoms`, `severity`, `companion`, `startDate`) VALUES ('111.111.111-11', 'Maju', '1980-02-26', 'Feminino', 'Rua', 'Pneumoultramicroscopicossilicovulcanoconiose', 'Alta', 'Jorge', '2020-11-24')");
    $pdo->prepare("INSERT INTO `attendances` (`patient_cpf`, `attendance_date`, `attendance_time`) VALUES (?,?,?)")->execute(['111.111.111-11', date("Y-m-d",time()), '12:00']);
  } catch (PDOException $e) {
    echo "Erro com banco de dados: ".$e->getMessage();
  } catch (Exception $e) {
    echo "Erro generico: ".$e->getMessage();
  }


  header("Location: ./index.php");
?>
