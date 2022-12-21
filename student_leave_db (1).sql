-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 05, 2022 at 11:11 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_leave_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(10) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `course_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_code`, `course_name`) VALUES
(1, 'CSS 123', 'AI'),
(2, 'CSS 122', 'Database');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_Id` int(10) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `faculty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_Id`, `department_name`, `faculty`) VALUES
(1, 'CSS', 1),
(2, 'MSS', 1),
(3, 'EMS', 1),
(4, 'CASE', 2);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(10) NOT NULL,
  `faculty_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`) VALUES
(1, 'Faculty Of Science and Technology'),
(2, 'Faculty Social Science ');

-- --------------------------------------------------------

--
-- Table structure for table `leave_course`
--

CREATE TABLE `leave_course` (
  `leave_course_id` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('proccessing','accepted','declined') NOT NULL DEFAULT 'proccessing'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_course`
--

INSERT INTO `leave_course` (`leave_course_id`, `course`, `leave_id`, `date`, `status`) VALUES
(8, 1, 1, '2022-07-05 20:11:35', 'proccessing'),
(9, 2, 1, '2022-07-05 20:11:47', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `leave_form`
--

CREATE TABLE `leave_form` (
  `leave_id` int(10) NOT NULL,
  `date_of_depacture` date NOT NULL,
  `date_of_return` date NOT NULL,
  `student` int(10) NOT NULL,
  `reason` varchar(250) NOT NULL,
  `date_submited` timestamp NOT NULL DEFAULT current_timestamp(),
  `current` tinyint(4) NOT NULL DEFAULT 1,
  `status` enum('accepted','rejected','proccessing') NOT NULL DEFAULT 'proccessing'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_form`
--

INSERT INTO `leave_form` (`leave_id`, `date_of_depacture`, `date_of_return`, `student`, `reason`, `date_submited`, `current`, `status`) VALUES
(1, '2022-07-06', '2022-07-07', 1, 'Am sick', '2022-07-05 20:09:26', 0, 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_course`
--

CREATE TABLE `lecturer_course` (
  `lecturer_course_id` int(10) NOT NULL,
  `staff` int(10) NOT NULL,
  `course` int(10) NOT NULL,
  `title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer_course`
--

INSERT INTO `lecturer_course` (`lecturer_course_id`, `staff`, `course`, `title`) VALUES
(2, 1, 2, 'lecturer'),
(4, 1, 1, 'TA'),
(6, 2, 2, 'TA');

-- --------------------------------------------------------

--
-- Table structure for table `programe_course`
--

CREATE TABLE `programe_course` (
  `programe_course_id` int(10) NOT NULL,
  `programe` int(10) NOT NULL,
  `course` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programe_course`
--

INSERT INTO `programe_course` (`programe_course_id`, `programe`, `course`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

CREATE TABLE `programme` (
  `programme_id` int(10) NOT NULL,
  `programme_name` varchar(100) NOT NULL,
  `depertment` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`programme_id`, `programme_name`, `depertment`) VALUES
(1, 'Bsc ICTM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(10) NOT NULL,
  `worker_id` varchar(30) NOT NULL,
  `role` varchar(60) NOT NULL,
  `user` int(10) NOT NULL,
  `department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `worker_id`, `role`, `user`, `department`) VALUES
(1, 'mu-staff-2045', 'hod', 2, 1),
(2, 'mu-staff-2529', 'staff', 4, 1),
(3, 'mu-staff-2163', 'dean', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(10) NOT NULL,
  `reg_number` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `programme` int(10) NOT NULL,
  `user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `reg_number`, `DOB`, `programme`, `user`) VALUES
(1, '14322853/T.22', '2000-01-03', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(10) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `middle_name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `sex` char(1) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone_number` int(50) NOT NULL,
  `status` varchar(40) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `first_name`, `middle_name`, `surname`, `username`, `sex`, `email`, `phone_number`, `status`, `password`) VALUES
(1, 'Goodlacky', 'E', 'Mwakyusa', 'wise', 'M', 'wise@gmail.com', 762343232, 'admin', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'Gwakisa', 'Mpili', 'Emmanuel', 'mu-staff-2045', 'F', 'gwakisa.emmanuel24114@mzumbe.ac.tz', 762506012, 'hod', '0d0de813c1105498e3435dd2fbf7fa26'),
(3, 'Shija', 'Shija', 'Msanja', '14322853/T.22', 'M', 'shija.msanja938@mustudent.ac.tz', 674885984, 'student', '0877b2b6c11df221ed62ee1e0afb5ee2'),
(4, 'aulila', 'Middle', 'Emmanuel', 'mu-staff-2529', 'F', 'aulila.emmanuel7735@mzumbe.ac.tz', 762506000, 'staff', '0d0de813c1105498e3435dd2fbf7fa26'),
(5, 'Gwakisa', 'Middle', 'Mpili', 'mu-staff-2163', 'M', 'gwakisa.mpili38774@mzumbe.ac.tz', 762006012, 'dean', '4c70e5aa27e48db05379d0eaa66ebb18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_Id`),
  ADD KEY `dept_faculty` (`faculty`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`),
  ADD UNIQUE KEY `faculty_name` (`faculty_name`);

--
-- Indexes for table `leave_course`
--
ALTER TABLE `leave_course`
  ADD PRIMARY KEY (`leave_course_id`),
  ADD UNIQUE KEY `leave_id` (`leave_id`,`course`),
  ADD KEY `course_fk` (`course`);

--
-- Indexes for table `leave_form`
--
ALTER TABLE `leave_form`
  ADD PRIMARY KEY (`leave_id`),
  ADD KEY `leave_student` (`student`);

--
-- Indexes for table `lecturer_course`
--
ALTER TABLE `lecturer_course`
  ADD PRIMARY KEY (`lecturer_course_id`),
  ADD KEY `lect_course` (`course`),
  ADD KEY `stf_corse` (`staff`);

--
-- Indexes for table `programe_course`
--
ALTER TABLE `programe_course`
  ADD PRIMARY KEY (`programe_course_id`),
  ADD KEY `prog_course` (`programe`),
  ADD KEY `cours_prog` (`course`);

--
-- Indexes for table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`programme_id`),
  ADD KEY `prog_dept` (`depertment`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `worker_id` (`worker_id`),
  ADD KEY `staff_user` (`user`),
  ADD KEY `staff_deparment` (`department`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `reg_number` (`reg_number`),
  ADD KEY `student_user` (`user`),
  ADD KEY `program_student` (`programme`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leave_course`
--
ALTER TABLE `leave_course`
  MODIFY `leave_course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leave_form`
--
ALTER TABLE `leave_form`
  MODIFY `leave_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lecturer_course`
--
ALTER TABLE `lecturer_course`
  MODIFY `lecturer_course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `programe_course`
--
ALTER TABLE `programe_course`
  MODIFY `programe_course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `programme`
--
ALTER TABLE `programme`
  MODIFY `programme_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `dept_faculty` FOREIGN KEY (`faculty`) REFERENCES `faculty` (`faculty_id`) ON UPDATE CASCADE;

--
-- Constraints for table `leave_course`
--
ALTER TABLE `leave_course`
  ADD CONSTRAINT `course_fk` FOREIGN KEY (`course`) REFERENCES `course` (`course_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_fk` FOREIGN KEY (`leave_id`) REFERENCES `leave_form` (`leave_id`) ON UPDATE CASCADE;

--
-- Constraints for table `leave_form`
--
ALTER TABLE `leave_form`
  ADD CONSTRAINT `leave_student` FOREIGN KEY (`student`) REFERENCES `student` (`student_id`) ON UPDATE CASCADE;

--
-- Constraints for table `lecturer_course`
--
ALTER TABLE `lecturer_course`
  ADD CONSTRAINT `lect_course` FOREIGN KEY (`course`) REFERENCES `course` (`course_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stf_corse` FOREIGN KEY (`staff`) REFERENCES `staff` (`staff_id`) ON UPDATE CASCADE;

--
-- Constraints for table `programe_course`
--
ALTER TABLE `programe_course`
  ADD CONSTRAINT `cours_prog` FOREIGN KEY (`course`) REFERENCES `course` (`course_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prog_course` FOREIGN KEY (`programe`) REFERENCES `programme` (`programme_id`) ON UPDATE CASCADE;

--
-- Constraints for table `programme`
--
ALTER TABLE `programme`
  ADD CONSTRAINT `prog_dept` FOREIGN KEY (`depertment`) REFERENCES `department` (`dept_Id`) ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_deparment` FOREIGN KEY (`department`) REFERENCES `department` (`dept_Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_user` FOREIGN KEY (`user`) REFERENCES `user` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `program_student` FOREIGN KEY (`programme`) REFERENCES `programme` (`programme_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `student_user` FOREIGN KEY (`user`) REFERENCES `user` (`userID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
