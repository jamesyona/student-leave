-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 30, 2022 at 07:41 PM
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
(1, 'CSS 200', 'AI'),
(2, 'CSS 128', 'DATABASE'),
(3, 'CSS 300', 'SIJUI');

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
(1, 'CSS', 1);

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
(1, 'FST');

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
(1, 2, 1, '2022-06-23 20:31:39', 'accepted'),
(3, 3, 1, '2022-06-23 20:31:50', 'proccessing'),
(5, 2, 3, '2022-06-28 19:30:14', 'accepted'),
(6, 1, 4, '2022-06-30 16:10:42', 'proccessing'),
(7, 2, 4, '2022-06-30 16:11:17', 'proccessing');

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
(1, '2022-06-24', '2022-06-25', 1, 'I am sick', '2022-06-23 20:31:27', 0, 'rejected'),
(2, '2022-06-26', '2022-07-06', 2, 'Please allow me to leave from university, I going to the hospital because I\'m sick, so I am going for more check up. Thanks!\r\n\r\nYour sincerely student ITS II. ', '2022-06-25 14:05:43', 0, 'proccessing'),
(3, '2022-06-28', '2022-06-28', 1, 'sfksdlfk;d fsdjlfjsldjflsjdlfs sdfjsidfiosjdofiijsdf sdfjsdofjosdjfio', '2022-06-28 19:30:05', 0, 'rejected'),
(4, '2022-06-30', '2022-07-01', 1, 'heyy', '2022-06-30 16:04:54', 1, 'proccessing');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_course`
--

CREATE TABLE `lecturer_course` (
  `lecturer_course_id` int(10) NOT NULL,
  `staff` int(10) NOT NULL,
  `course` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer_course`
--

INSERT INTO `lecturer_course` (`lecturer_course_id`, `staff`, `course`) VALUES
(1, 1, 2),
(2, 1, 1),
(3, 2, 3),
(4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permission_id` int(10) NOT NULL,
  `staff` int(10) NOT NULL,
  `leave_fom` int(10) NOT NULL,
  `is_permitted` varchar(10) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'bSC its', 1),
(2, 'Bsc ICTB', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(10) NOT NULL,
  `worker_id` varchar(30) NOT NULL,
  `role` varchar(60) NOT NULL,
  `user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `worker_id`, `role`, `user`) VALUES
(1, '1234', 'lecturer', 3),
(2, '4321', 'lecturer', 2),
(3, 'mu-staff-2835', 'lecture', 14);

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
(1, '14322007/T.20', '2022-06-22', 1, 1),
(2, '14322009/T.19', '2016-11-29', 2, 4),
(4, '14322307/T.22', '2022-06-27', 2, 7);

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
(1, 'Goodluck', 'G', 'Mwakyusa', 'wise', 'M', 'thewise@gmail.com', 768754219, 'student', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'James', 'B', 'Bondi', 'messi', 'M', 'james@gmail.com', 657891256, 'staff', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'George', 'E', 'Mwakapuku', 'gets', 'M', 'gets@gmail.com', 788654312, 'admin', '81dc9bdb52d04dc20036dbd8313ed055'),
(4, 'Kemmy', 'H', 'Mzumbe', 'kemi', 'F', 'kemmy@gmail.com', 788239014, 'student', '81dc9bdb52d04dc20036dbd8313ed055'),
(5, 'Mwajuma', 'K', 'Ndalandefu', 'mwajuma', 'F', 'mwaj@gmail.com', 788654314, 'student', '81dc9bdb52d04dc20036dbd8313ed055'),
(7, 'Wise', 'wise', 'Wise', '14322307/T.22', 'F', 'wise.wise6758@mzumbe.ac.tz', 762506001, 'student', 'dbf4c379c5873e57d909a025ac8f38c2'),
(14, 'Gwakisa', 'Emma', 'Emmanuel', 'mu-staff-2835', 'F', 'gwakisa.emmanuel4960@mzumbe.ac.tz', 862506012, 'staff', '0d0de813c1105498e3435dd2fbf7fa26');

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
  ADD PRIMARY KEY (`faculty_id`);

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
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `permission_staff` (`staff`),
  ADD KEY `permission_leave` (`leave_fom`);

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
  ADD KEY `staff_user` (`user`);

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
  MODIFY `course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leave_course`
--
ALTER TABLE `leave_course`
  MODIFY `leave_course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `leave_form`
--
ALTER TABLE `leave_form`
  MODIFY `leave_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lecturer_course`
--
ALTER TABLE `lecturer_course`
  MODIFY `lecturer_course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permission_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programe_course`
--
ALTER TABLE `programe_course`
  MODIFY `programe_course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `programme`
--
ALTER TABLE `programme`
  MODIFY `programme_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_leave` FOREIGN KEY (`leave_fom`) REFERENCES `leave_form` (`leave_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_staff` FOREIGN KEY (`staff`) REFERENCES `staff` (`staff_id`) ON UPDATE CASCADE;

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
