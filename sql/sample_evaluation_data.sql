-- Additional Sample Data for Faculty Evaluations
-- This file adds more evaluation records with complete rating details

-- Insert additional evaluations
INSERT INTO `evaluations` (`faculty_name`, `semester`, `school_year`, `total_units`, `subject_handled`, `sec1_avg`, `sec2_avg`, `sec3_avg`, `sec4_avg`, `sec5_avg`, `total_points`, `overall_rating`, `additional_comments`, `official_complaint`, `exceptional_performance`, `date_submitted`) VALUES
-- Evaluation 11: Homer Favenir - 1ST Semester 2025-2026
('Homer Favenir', '1ST', '2025-2026', 21, 'Data Structures, Programming Logic, Computer Fundamentals', 4.333, 4.636, 4.400, 4.500, 4.500, 113, 4.52, 'Shows good teaching methodology but could improve on assessment feedback timing.', 'no', 'no', '2026-01-15 10:30:00'),

-- Evaluation 12: Fe Antonio - 2ND Semester 2025-2026
('Fe Antonio', '2ND', '2025-2026', 18, 'Database Management, Web Development, Systems Analysis', 4.667, 4.909, 4.800, 4.750, 5.000, 122, 4.89, 'Excellent engagement with students. Very responsive to student concerns.', 'no', 'yes', '2026-01-18 14:20:00'),

-- Evaluation 13: Val Patrick Fabregas - 2ND Semester 2024-2025
('Val Patrick Fabregas', '2ND', '2024-2025', 24, 'Advanced Programming, Mobile Development, Software Engineering', 4.667, 4.727, 4.600, 4.250, 4.500, 116, 4.65, 'Strong technical knowledge. Could improve on providing more real-world examples.', 'no', 'no', '2025-06-10 09:15:00'),

-- Evaluation 14: Marco Antonio Subion - SUMMER Semester 2024-2025
('Marco Antonio Subion', 'SUMMER', '2024-2025', 15, 'Introduction to Computing, Computer Programming', 4.333, 4.455, 4.200, 4.000, 4.500, 109, 4.38, 'Good instructor but needs to slow down the pace for complex topics.', 'no', 'no', '2025-08-05 11:45:00'),

-- Evaluation 15: Roberto Malitao - 2ND Semester 2025-2026
('Roberto Malitao', '2ND', '2025-2026', 21, 'Operating Systems, Computer Networks, System Administration', 5.000, 4.909, 5.000, 5.000, 5.000, 124, 4.98, 'Outstanding performance. Demonstrates exceptional expertise and student engagement.', 'no', 'yes', '2026-01-25 16:00:00'),

-- Evaluation 16: Arnold Galve - 1ST Semester 2024-2025
('Arnold Galve', '1ST', '2024-2025', 18, 'Algorithm Design, Data Mining, Artificial Intelligence', 4.333, 4.545, 4.400, 4.500, 4.500, 113, 4.52, 'Very knowledgeable in the field. Students appreciate the challenging coursework.', 'no', 'no', '2025-01-20 13:30:00'),

-- Evaluation 17: Edward Cruz - 2ND Semester 2024-2025
('Edward Cruz', '2ND', '2024-2025', 24, 'Discrete Mathematics, Numerical Methods, Statistics', 4.000, 4.364, 4.200, 4.250, 4.500, 107, 4.30, 'Clear explanations but could provide more practice exercises.', 'no', 'no', '2025-06-15 10:00:00'),

-- Evaluation 18: Luvim Eusebio - 1ST Semester 2025-2026
('Luvim Eusebio', '1ST', '2025-2026', 21, 'Information Security, Ethical Hacking, Cybersecurity', 4.667, 4.818, 4.800, 4.750, 5.000, 121, 4.85, 'Excellent instructor with practical industry knowledge. Highly engaging classes.', 'no', 'yes', '2026-01-22 15:45:00'),

-- Evaluation 19: Rolando Quirong - 2ND Semester 2025-2026
('Rolando Quirong', '2ND', '2025-2026', 18, 'Web Programming, Framework Development, Cloud Computing', 4.667, 4.727, 4.600, 4.500, 5.000, 119, 4.77, 'Very helpful during consultation hours. Makes complex topics understandable.', 'no', 'yes', '2026-01-28 11:20:00'),

-- Evaluation 20: Homer Favenir - SUMMER Semester 2025-2026
('Homer Favenir', 'SUMMER', '2025-2026', 12, 'Introduction to Programming, Basic Algorithms', 4.000, 4.273, 4.000, 4.000, 4.000, 102, 4.11, 'Satisfactory performance. Students suggest more hands-on activities.', 'no', 'no', '2026-05-12 09:30:00'),

-- Evaluation 21: Fe Antonio - 1ST Semester 2024-2025
('Fe Antonio', '1ST', '2024-2025', 21, 'Software Quality Assurance, Project Management, Capstone', 4.667, 4.909, 4.800, 4.750, 5.000, 122, 4.89, 'Excellent mentorship for capstone projects. Very supportive and professional.', 'no', 'yes', '2025-01-18 14:50:00'),

-- Evaluation 22: Marco Antonio Subion - 1ST Semester 2024-2025
('Marco Antonio Subion', '1ST', '2024-2025', 18, 'Human Computer Interaction, UI/UX Design, Graphics', 4.333, 4.636, 4.600, 4.500, 4.500, 114, 4.56, 'Creative approach to teaching. Students enjoy the design projects.', 'no', 'no', '2025-01-19 10:15:00'),

-- Evaluation 23: Roberto Malitao - SUMMER Semester 2024-2025
('Roberto Malitao', 'SUMMER', '2024-2025', 15, 'Computer Architecture, Digital Logic Design', 4.667, 4.818, 4.600, 4.750, 5.000, 120, 4.80, 'Strong fundamentals teaching. Makes difficult concepts accessible.', 'no', 'yes', '2025-08-10 13:00:00'),

-- Evaluation 24: Edward Cruz - SUMMER Semester 2025-2026
('Edward Cruz', 'SUMMER', '2025-2026', 12, 'Research Methods, Technical Writing', 3.667, 4.091, 3.800, 4.000, 4.000, 97, 3.91, 'Could improve on providing clearer guidelines for research papers.', 'no', 'no', '2026-05-18 11:00:00'),

-- Evaluation 25: Luvim Eusebio - 2ND Semester 2024-2025
('Luvim Eusebio', '2ND', '2024-2025', 24, 'Network Security, Penetration Testing, Digital Forensics', 5.000, 5.000, 5.000, 5.000, 5.000, 125, 5.00, 'Perfect evaluation. Outstanding expertise and teaching ability. Highly recommended.', 'no', 'yes', '2025-06-12 16:30:00');

-- Get the starting evaluation_id for detailed ratings
SET @eval_id = (SELECT MAX(id) FROM evaluations) - 14;

-- Evaluation Details for Evaluation 11 (Homer Favenir - 1ST 2025-2026)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id, 'sec1_q1', 4), (@eval_id, 'sec1_q2', 4), (@eval_id, 'sec1_q3', 5),
(@eval_id, 'sec2_q1', 5), (@eval_id, 'sec2_q2', 5), (@eval_id, 'sec2_q3', 4),
(@eval_id, 'sec2_q4', 5), (@eval_id, 'sec2_q5', 4), (@eval_id, 'sec2_q6', 5),
(@eval_id, 'sec2_q7', 5), (@eval_id, 'sec2_q8', 5), (@eval_id, 'sec2_q9', 4),
(@eval_id, 'sec2_q10', 5), (@eval_id, 'sec2_q11', 5),
(@eval_id, 'sec3_q1', 4), (@eval_id, 'sec3_q2', 5), (@eval_id, 'sec3_q3', 4),
(@eval_id, 'sec3_q4', 5), (@eval_id, 'sec3_q5', 4),
(@eval_id, 'sec4_q1', 5), (@eval_id, 'sec4_q2', 4), (@eval_id, 'sec4_q3', 5), (@eval_id, 'sec4_q4', 4),
(@eval_id, 'sec5_q1', 5), (@eval_id, 'sec5_q2', 4);

-- Evaluation Details for Evaluation 12 (Fe Antonio - 2ND 2025-2026)
SET @eval_id = @eval_id + 1;
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id, 'sec1_q1', 5), (@eval_id, 'sec1_q2', 4), (@eval_id, 'sec1_q3', 5),
(@eval_id, 'sec2_q1', 5), (@eval_id, 'sec2_q2', 5), (@eval_id, 'sec2_q3', 5),
(@eval_id, 'sec2_q4', 5), (@eval_id, 'sec2_q5', 5), (@eval_id, 'sec2_q6', 5),
(@eval_id, 'sec2_q7', 4), (@eval_id, 'sec2_q8', 5), (@eval_id, 'sec2_q9', 5),
(@eval_id, 'sec2_q10', 5), (@eval_id, 'sec2_q11', 5),
(@eval_id, 'sec3_q1', 5), (@eval_id, 'sec3_q2', 5), (@eval_id, 'sec3_q3', 4),
(@eval_id, 'sec3_q4', 5), (@eval_id, 'sec3_q5', 5),
(@eval_id, 'sec4_q1', 5), (@eval_id, 'sec4_q2', 4), (@eval_id, 'sec4_q3', 5), (@eval_id, 'sec4_q4', 5),
(@eval_id, 'sec5_q1', 5), (@eval_id, 'sec5_q2', 5);

-- Evaluation Details for Evaluation 13 (Val Patrick Fabregas - 2ND 2024-2025)
SET @eval_id = @eval_id + 1;
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id, 'sec1_q1', 5), (@eval_id, 'sec1_q2', 4), (@eval_id, 'sec1_q3', 5),
(@eval_id, 'sec2_q1', 5), (@eval_id, 'sec2_q2', 5), (@eval_id, 'sec2_q3', 4),
(@eval_id, 'sec2_q4', 5), (@eval_id, 'sec2_q5', 5), (@eval_id, 'sec2_q6', 5),
(@eval_id, 'sec2_q7', 4), (@eval_id, 'sec2_q8', 5), (@eval_id, 'sec2_q9', 5),
(@eval_id, 'sec2_q10', 5), (@eval_id, 'sec2_q11', 4),
(@eval_id, 'sec3_q1', 5), (@eval_id, 'sec3_q2', 5), (@eval_id, 'sec3_q3', 4),
(@eval_id, 'sec3_q4', 5), (@eval_id, 'sec3_q5', 4),
(@eval_id, 'sec4_q1', 4), (@eval_id, 'sec4_q2', 4), (@eval_id, 'sec4_q3', 5), (@eval_id, 'sec4_q4', 4),
(@eval_id, 'sec5_q1', 4), (@eval_id, 'sec5_q2', 5);

-- Evaluation Details for Evaluation 14 (Marco Antonio Subion - SUMMER 2024-2025)
SET @eval_id = @eval_id + 1;
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id, 'sec1_q1', 4), (@eval_id, 'sec1_q2', 4), (@eval_id, 'sec1_q3', 5),
(@eval_id, 'sec2_q1', 5), (@eval_id, 'sec2_q2', 4), (@eval_id, 'sec2_q3', 4),
(@eval_id, 'sec2_q4', 5), (@eval_id, 'sec2_q5', 4), (@eval_id, 'sec2_q6', 5),
(@eval_id, 'sec2_q7', 4), (@eval_id, 'sec2_q8', 5), (@eval_id, 'sec2_q9', 4),
(@eval_id, 'sec2_q10', 5), (@eval_id, 'sec2_q11', 4),
(@eval_id, 'sec3_q1', 4), (@eval_id, 'sec3_q2', 4), (@eval_id, 'sec3_q3', 4),
(@eval_id, 'sec3_q4', 5), (@eval_id, 'sec3_q5', 4),
(@eval_id, 'sec4_q1', 4), (@eval_id, 'sec4_q2', 4), (@eval_id, 'sec4_q3', 4), (@eval_id, 'sec4_q4', 4),
(@eval_id, 'sec5_q1', 5), (@eval_id, 'sec5_q2', 4);

-- Evaluation Details for Evaluation 15 (Roberto Malitao - 2ND 2025-2026)
SET @eval_id = @eval_id + 1;
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id, 'sec1_q1', 5), (@eval_id, 'sec1_q2', 5), (@eval_id, 'sec1_q3', 5),
(@eval_id, 'sec2_q1', 5), (@eval_id, 'sec2_q2', 5), (@eval_id, 'sec2_q3', 5),
(@eval_id, 'sec2_q4', 5), (@eval_id, 'sec2_q5', 5), (@eval_id, 'sec2_q6', 5),
(@eval_id, 'sec2_q7', 4), (@eval_id, 'sec2_q8', 5), (@eval_id, 'sec2_q9', 5),
(@eval_id, 'sec2_q10', 5), (@eval_id, 'sec2_q11', 5),
(@eval_id, 'sec3_q1', 5), (@eval_id, 'sec3_q2', 5), (@eval_id, 'sec3_q3', 5),
(@eval_id, 'sec3_q4', 5), (@eval_id, 'sec3_q5', 5),
(@eval_id, 'sec4_q1', 5), (@eval_id, 'sec4_q2', 5), (@eval_id, 'sec4_q3', 5), (@eval_id, 'sec4_q4', 5),
(@eval_id, 'sec5_q1', 5), (@eval_id, 'sec5_q2', 5);

-- Evaluation Details for Evaluation 16 (Arnold Galve - 1ST 2024-2025)
SET @eval_id = @eval_id + 1;
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id, 'sec1_q1', 4), (@eval_id, 'sec1_q2', 4), (@eval_id, 'sec1_q3', 5),
(@eval_id, 'sec2_q1', 5), (@eval_id, 'sec2_q2', 5), (@eval_id, 'sec2_q3', 4),
(@eval_id, 'sec2_q4', 5), (@eval_id, 'sec2_q5', 4), (@eval_id, 'sec2_q6', 5),
(@eval_id, 'sec2_q7', 5), (@eval_id, 'sec2_q8', 4), (@eval_id, 'sec2_q9', 5),
(@eval_id, 'sec2_q10', 4), (@eval_id, 'sec2_q11', 5),
(@eval_id, 'sec3_q1', 4), (@eval_id, 'sec3_q2', 5), (@eval_id, 'sec3_q3', 4),
(@eval_id, 'sec3_q4', 5), (@eval_id, 'sec3_q5', 4),
(@eval_id, 'sec4_q1', 5), (@eval_id, 'sec4_q2', 4), (@eval_id, 'sec4_q3', 5), (@eval_id, 'sec4_q4', 4),
(@eval_id, 'sec5_q1', 5), (@eval_id, 'sec5_q2', 4);

-- Evaluation Details for Evaluation 17 (Edward Cruz - 2ND 2024-2025)
SET @eval_id = @eval_id + 1;
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id, 'sec1_q1', 4), (@eval_id, 'sec1_q2', 4), (@eval_id, 'sec1_q3', 4),
(@eval_id, 'sec2_q1', 5), (@eval_id, 'sec2_q2', 4), (@eval_id, 'sec2_q3', 4),
(@eval_id, 'sec2_q4', 5), (@eval_id, 'sec2_q5', 4), (@eval_id, 'sec2_q6', 5),
(@eval_id, 'sec2_q7', 4), (@eval_id, 'sec2_q8', 5), (@eval_id, 'sec2_q9', 4),
(@eval_id, 'sec2_q10', 4), (@eval_id, 'sec2_q11', 5),
(@eval_id, 'sec3_q1', 4), (@eval_id, 'sec3_q2', 4), (@eval_id, 'sec3_q3', 4),
(@eval_id, 'sec3_q4', 5), (@eval_id, 'sec3_q5', 4),
(@eval_id, 'sec4_q1', 4), (@eval_id, 'sec4_q2', 4), (@eval_id, 'sec4_q3', 4), (@eval_id, 'sec4_q4', 5),
(@eval_id, 'sec5_q1', 5), (@eval_id, 'sec5_q2', 4);

-- Evaluation Details for Evaluation 18 (Luvim Eusebio - 1ST 2025-2026)
SET @eval_id = @eval_id + 1;
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id, 'sec1_q1', 5), (@eval_id, 'sec1_q2', 4), (@eval_id, 'sec1_q3', 5),
(@eval_id, 'sec2_q1', 5), (@eval_id, 'sec2_q2', 5), (@eval_id, 'sec2_q3', 5),
(@eval_id, 'sec2_q4', 5), (@eval_id, 'sec2_q5', 5), (@eval_id, 'sec2_q6', 5),
(@eval_id, 'sec2_q7', 4), (@eval_id, 'sec2_q8', 5), (@eval_id, 'sec2_q9', 5),
(@eval_id, 'sec2_q10', 5), (@eval_id, 'sec2_q11', 5),
(@eval_id, 'sec3_q1', 5), (@eval_id, 'sec3_q2', 5), (@eval_id, 'sec3_q3', 4),
(@eval_id, 'sec3_q4', 5), (@eval_id, 'sec3_q5', 5),
(@eval_id, 'sec4_q1', 5), (@eval_id, 'sec4_q2', 4), (@eval_id, 'sec4_q3', 5), (@eval_id, 'sec4_q4', 5),
(@eval_id, 'sec5_q1', 5), (@eval_id, 'sec5_q2', 5);

-- Evaluation Details for Evaluation 19 (Rolando Quirong - 2ND 2025-2026)
SET @eval_id = @eval_id + 1;
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id, 'sec1_q1', 5), (@eval_id, 'sec1_q2', 4), (@eval_id, 'sec1_q3', 5),
(@eval_id, 'sec2_q1', 5), (@eval_id, 'sec2_q2', 5), (@eval_id, 'sec2_q3', 4),
(@eval_id, 'sec2_q4', 5), (@eval_id, 'sec2_q5', 5), (@eval_id, 'sec2_q6', 5),
(@eval_id, 'sec2_q7', 4), (@eval_id, 'sec2_q8', 5), (@eval_id, 'sec2_q9', 5),
(@eval_id, 'sec2_q10', 5), (@eval_id, 'sec2_q11', 4),
(@eval_id, 'sec3_q1', 5), (@eval_id, 'sec3_q2', 5), (@eval_id, 'sec3_q3', 4),
(@eval_id, 'sec3_q4', 5), (@eval_id, 'sec3_q5', 4),
(@eval_id, 'sec4_q1', 5), (@eval_id, 'sec4_q2', 4), (@eval_id, 'sec4_q3', 5), (@eval_id, 'sec4_q4', 4),
(@eval_id, 'sec5_q1', 5), (@eval_id, 'sec5_q2', 5);

-- Evaluation Details for Evaluation 20 (Homer Favenir - SUMMER 2025-2026)
SET @eval_id = @eval_id + 1;
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id, 'sec1_q1', 4), (@eval_id, 'sec1_q2', 4), (@eval_id, 'sec1_q3', 4),
(@eval_id, 'sec2_q1', 4), (@eval_id, 'sec2_q2', 4), (@eval_id, 'sec2_q3', 4),
(@eval_id, 'sec2_q4', 5), (@eval_id, 'sec2_q5', 4), (@eval_id, 'sec2_q6', 5),
(@eval_id, 'sec2_q7', 4), (@eval_id, 'sec2_q8', 5), (@eval_id, 'sec2_q9', 4),
(@eval_id, 'sec2_q10', 4), (@eval_id, 'sec2_q11', 4),
(@eval_id, 'sec3_q1', 4), (@eval_id, 'sec3_q2', 4), (@eval_id, 'sec3_q3', 4),
(@eval_id, 'sec3_q4', 4), (@eval_id, 'sec3_q5', 4),
(@eval_id, 'sec4_q1', 4), (@eval_id, 'sec4_q2', 4), (@eval_id, 'sec4_q3', 4), (@eval_id, 'sec4_q4', 4),
(@eval_id, 'sec5_q1', 4), (@eval_id, 'sec5_q2', 4);

-- Evaluation Details for Evaluation 21 (Fe Antonio - 1ST 2024-2025)
SET @eval_id = @eval_id + 1;
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id, 'sec1_q1', 5), (@eval_id, 'sec1_q2', 4), (@eval_id, 'sec1_q3', 5),
(@eval_id, 'sec2_q1', 5), (@eval_id, 'sec2_q2', 5), (@eval_id, 'sec2_q3', 5),
(@eval_id, 'sec2_q4', 5), (@eval_id, 'sec2_q5', 5), (@eval_id, 'sec2_q6', 5),
(@eval_id, 'sec2_q7', 4), (@eval_id, 'sec2_q8', 5), (@eval_id, 'sec2_q9', 5),
(@eval_id, 'sec2_q10', 5), (@eval_id, 'sec2_q11', 5),
(@eval_id, 'sec3_q1', 5), (@eval_id, 'sec3_q2', 5), (@eval_id, 'sec3_q3', 4),
(@eval_id, 'sec3_q4', 5), (@eval_id, 'sec3_q5', 5),
(@eval_id, 'sec4_q1', 5), (@eval_id, 'sec4_q2', 4), (@eval_id, 'sec4_q3', 5), (@eval_id, 'sec4_q4', 5),
(@eval_id, 'sec5_q1', 5), (@eval_id, 'sec5_q2', 5);

-- Evaluation Details for Evaluation 22 (Marco Antonio Subion - 1ST 2024-2025)
SET @eval_id = @eval_id + 1;
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id, 'sec1_q1', 4), (@eval_id, 'sec1_q2', 4), (@eval_id, 'sec1_q3', 5),
(@eval_id, 'sec2_q1', 5), (@eval_id, 'sec2_q2', 5), (@eval_id, 'sec2_q3', 4),
(@eval_id, 'sec2_q4', 5), (@eval_id, 'sec2_q5', 5), (@eval_id, 'sec2_q6', 5),
(@eval_id, 'sec2_q7', 4), (@eval_id, 'sec2_q8', 5), (@eval_id, 'sec2_q9', 5),
(@eval_id, 'sec2_q10', 4), (@eval_id, 'sec2_q11', 5),
(@eval_id, 'sec3_q1', 5), (@eval_id, 'sec3_q2', 5), (@eval_id, 'sec3_q3', 4),
(@eval_id, 'sec3_q4', 5), (@eval_id, 'sec3_q5', 4),
(@eval_id, 'sec4_q1', 5), (@eval_id, 'sec4_q2', 4), (@eval_id, 'sec4_q3', 5), (@eval_id, 'sec4_q4', 4),
(@eval_id, 'sec5_q1', 5), (@eval_id, 'sec5_q2', 4);

-- Evaluation Details for Evaluation 23 (Roberto Malitao - SUMMER 2024-2025)
SET @eval_id = @eval_id + 1;
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id, 'sec1_q1', 5), (@eval_id, 'sec1_q2', 4), (@eval_id, 'sec1_q3', 5),
(@eval_id, 'sec2_q1', 5), (@eval_id, 'sec2_q2', 5), (@eval_id, 'sec2_q3', 5),
(@eval_id, 'sec2_q4', 5), (@eval_id, 'sec2_q5', 5), (@eval_id, 'sec2_q6', 5),
(@eval_id, 'sec2_q7', 4), (@eval_id, 'sec2_q8', 5), (@eval_id, 'sec2_q9', 5),
(@eval_id, 'sec2_q10', 5), (@eval_id, 'sec2_q11', 4),
(@eval_id, 'sec3_q1', 5), (@eval_id, 'sec3_q2', 5), (@eval_id, 'sec3_q3', 4),
(@eval_id, 'sec3_q4', 5), (@eval_id, 'sec3_q5', 4),
(@eval_id, 'sec4_q1', 5), (@eval_id, 'sec4_q2', 5), (@eval_id, 'sec4_q3', 4), (@eval_id, 'sec4_q4', 5),
(@eval_id, 'sec5_q1', 5), (@eval_id, 'sec5_q2', 5);

-- Evaluation Details for Evaluation 24 (Edward Cruz - SUMMER 2025-2026)
SET @eval_id = @eval_id + 1;
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id, 'sec1_q1', 3), (@eval_id, 'sec1_q2', 4), (@eval_id, 'sec1_q3', 4),
(@eval_id, 'sec2_q1', 4), (@eval_id, 'sec2_q2', 4), (@eval_id, 'sec2_q3', 4),
(@eval_id, 'sec2_q4', 4), (@eval_id, 'sec2_q5', 4), (@eval_id, 'sec2_q6', 5),
(@eval_id, 'sec2_q7', 4), (@eval_id, 'sec2_q8', 4), (@eval_id, 'sec2_q9', 4),
(@eval_id, 'sec2_q10', 4), (@eval_id, 'sec2_q11', 5),
(@eval_id, 'sec3_q1', 4), (@eval_id, 'sec3_q2', 4), (@eval_id, 'sec3_q3', 3),
(@eval_id, 'sec3_q4', 4), (@eval_id, 'sec3_q5', 4),
(@eval_id, 'sec4_q1', 4), (@eval_id, 'sec4_q2', 4), (@eval_id, 'sec4_q3', 4), (@eval_id, 'sec4_q4', 4),
(@eval_id, 'sec5_q1', 4), (@eval_id, 'sec5_q2', 4);

-- Evaluation Details for Evaluation 25 (Luvim Eusebio - 2ND 2024-2025)
SET @eval_id = @eval_id + 1;
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id, 'sec1_q1', 5), (@eval_id, 'sec1_q2', 5), (@eval_id, 'sec1_q3', 5),
(@eval_id, 'sec2_q1', 5), (@eval_id, 'sec2_q2', 5), (@eval_id, 'sec2_q3', 5),
(@eval_id, 'sec2_q4', 5), (@eval_id, 'sec2_q5', 5), (@eval_id, 'sec2_q6', 5),
(@eval_id, 'sec2_q7', 5), (@eval_id, 'sec2_q8', 5), (@eval_id, 'sec2_q9', 5),
(@eval_id, 'sec2_q10', 5), (@eval_id, 'sec2_q11', 5),
(@eval_id, 'sec3_q1', 5), (@eval_id, 'sec3_q2', 5), (@eval_id, 'sec3_q3', 5),
(@eval_id, 'sec3_q4', 5), (@eval_id, 'sec3_q5', 5),
(@eval_id, 'sec4_q1', 5), (@eval_id, 'sec4_q2', 5), (@eval_id, 'sec4_q3', 5), (@eval_id, 'sec4_q4', 5),
(@eval_id, 'sec5_q1', 5), (@eval_id, 'sec5_q2', 5);

-- =====================================================
-- Additional Evaluations (26-75) for Extended Sample Data
-- School Years: 2022-2023 and 2023-2024
-- =====================================================

INSERT INTO `evaluations` (`faculty_name`, `semester`, `school_year`, `total_units`, `subject_handled`, `sec1_avg`, `sec2_avg`, `sec3_avg`, `sec4_avg`, `sec5_avg`, `total_points`, `overall_rating`, `additional_comments`, `official_complaint`, `exceptional_performance`, `date_submitted`) VALUES
-- Evaluation 26: Homer Favenir - 1ST Semester 2022-2023
('Homer Favenir', '1ST', '2022-2023', 21, 'Data Structures, Programming Logic, Computer Fundamentals', 4.333, 4.636, 4.400, 4.500, 4.500, 113, 4.52, 'Students appreciate the structured approach but request more practical examples.', 'no', 'no', '2022-11-15 10:30:00'),

-- Evaluation 27: Fe Antonio - 1ST Semester 2022-2023
('Fe Antonio', '1ST', '2022-2023', 18, 'Database Management, Web Development, Systems Analysis', 4.667, 4.909, 4.800, 4.750, 5.000, 121, 4.84, 'Outstanding course organization and delivery. Students highly recommend.', 'no', 'yes', '2022-11-18 14:20:00'),

-- Evaluation 28: Val Patrick Fabregas - 1ST Semester 2022-2023
('Val Patrick Fabregas', '1ST', '2022-2023', 24, 'Object-Oriented Programming, Mobile Development, Software Engineering', 4.667, 4.727, 4.600, 4.500, 5.000, 117, 4.68, 'Well-prepared lectures with relevant industry examples and case studies.', 'no', 'no', '2022-11-20 09:15:00'),

-- Evaluation 29: Marco Antonio Subion - 1ST Semester 2022-2023
('Marco Antonio Subion', '1ST', '2022-2023', 18, 'Introduction to Computing, Computer Programming, HCI', 4.333, 4.364, 4.200, 4.250, 4.500, 108, 4.32, 'Well-structured course but could benefit from more hands-on activities.', 'no', 'no', '2022-11-22 11:45:00'),

-- Evaluation 30: Roberto Malitao - 1ST Semester 2022-2023
('Roberto Malitao', '1ST', '2022-2023', 21, 'Operating Systems, Computer Networks, System Administration', 5.000, 4.909, 5.000, 4.750, 5.000, 123, 4.92, 'Exceptional knowledge of computer systems. Inspiring lecturer.', 'no', 'yes', '2022-11-25 16:00:00'),

-- Evaluation 31: Arnold Galve - 1ST Semester 2022-2023
('Arnold Galve', '1ST', '2022-2023', 18, 'Algorithm Design, Data Mining, Artificial Intelligence', 4.333, 4.636, 4.600, 4.500, 4.500, 114, 4.56, 'Effective teaching of complex algorithmic concepts with clear examples.', 'no', 'no', '2022-11-28 13:30:00'),

-- Evaluation 32: Edward Cruz - 1ST Semester 2022-2023
('Edward Cruz', '1ST', '2022-2023', 24, 'Discrete Mathematics, Numerical Methods, Statistics', 3.667, 4.091, 3.800, 3.750, 4.000, 98, 3.92, 'Needs to improve pace and engagement in lectures. Material is dry.', 'no', 'no', '2022-12-01 10:00:00'),

-- Evaluation 33: Luvim Eusebio - 1ST Semester 2022-2023
('Luvim Eusebio', '1ST', '2022-2023', 21, 'Information Security, Ethical Hacking, Cybersecurity', 5.000, 5.000, 5.000, 5.000, 5.000, 125, 5.00, 'Perfect evaluation. Exceptional teaching ability. Highly recommended.', 'no', 'yes', '2022-12-03 15:45:00'),

-- Evaluation 34: Rolando Quirong - 1ST Semester 2022-2023
('Rolando Quirong', '1ST', '2022-2023', 18, 'Web Programming, Framework Development, Cloud Computing', 4.667, 4.727, 4.600, 4.500, 5.000, 117, 4.68, 'Effective web development instruction with current technology stack.', 'no', 'no', '2022-12-05 11:20:00'),

-- Evaluation 35: Homer Favenir - 2ND Semester 2022-2023
('Homer Favenir', '2ND', '2022-2023', 21, 'Algorithm Analysis, Advanced Programming, Software Design', 4.000, 4.273, 4.000, 4.250, 4.000, 104, 4.16, 'Adequate coverage of topics. Students suggest more interactive sessions.', 'no', 'no', '2023-05-10 10:30:00'),

-- Evaluation 36: Fe Antonio - 2ND Semester 2022-2023
('Fe Antonio', '2ND', '2022-2023', 21, 'Software Quality Assurance, Project Management, Capstone', 4.667, 4.727, 4.600, 4.500, 5.000, 117, 4.68, 'Very professional and knowledgeable. Provides excellent mentorship.', 'no', 'yes', '2023-05-12 14:20:00'),

-- Evaluation 37: Val Patrick Fabregas - 2ND Semester 2022-2023
('Val Patrick Fabregas', '2ND', '2022-2023', 24, 'Advanced Web Technologies, Mobile Development, Software Testing', 4.333, 4.636, 4.600, 4.500, 4.500, 114, 4.56, 'Good balance of theory and practice. Could improve assessment variety.', 'no', 'no', '2023-05-15 09:15:00'),

-- Evaluation 38: Marco Antonio Subion - 2ND Semester 2022-2023
('Marco Antonio Subion', '2ND', '2022-2023', 18, 'Human Computer Interaction, UI/UX Design, Graphics', 4.333, 4.636, 4.400, 4.500, 4.500, 113, 4.52, 'Students enjoy the design projects and collaborative activities.', 'no', 'no', '2023-05-18 11:45:00'),

-- Evaluation 39: Roberto Malitao - 2ND Semester 2022-2023
('Roberto Malitao', '2ND', '2022-2023', 21, 'Computer Architecture, Digital Logic Design, Microprocessors', 5.000, 4.727, 4.800, 4.750, 4.500, 119, 4.76, 'Students are highly motivated by the engaging teaching style.', 'no', 'yes', '2023-05-20 16:00:00'),

-- Evaluation 40: Arnold Galve - 2ND Semester 2022-2023
('Arnold Galve', '2ND', '2022-2023', 18, 'Machine Learning, Expert Systems, Data Analytics', 4.333, 4.545, 4.400, 4.500, 4.000, 111, 4.44, 'Good classroom management. Students enjoy the problem-solving approach.', 'no', 'no', '2023-05-22 13:30:00'),

-- Evaluation 41: Edward Cruz - 2ND Semester 2022-2023
('Edward Cruz', '2ND', '2022-2023', 24, 'Calculus for CS, Linear Algebra, Probability', 4.000, 4.273, 4.000, 4.250, 4.000, 104, 4.16, 'Students request more examples and step-by-step problem solving.', 'no', 'no', '2023-05-25 10:00:00'),

-- Evaluation 42: Luvim Eusebio - 2ND Semester 2022-2023
('Luvim Eusebio', '2ND', '2022-2023', 24, 'Network Security, Penetration Testing, Digital Forensics', 5.000, 4.909, 5.000, 4.750, 5.000, 123, 4.92, 'Outstanding cybersecurity expertise. Makes complex topics understandable.', 'no', 'yes', '2023-05-28 15:45:00'),

-- Evaluation 43: Rolando Quirong - 2ND Semester 2022-2023
('Rolando Quirong', '2ND', '2022-2023', 21, 'Full Stack Development, DevOps, API Design', 5.000, 4.727, 4.800, 4.750, 4.500, 119, 4.76, 'Students enjoy the project-based learning approach greatly.', 'no', 'yes', '2023-05-30 11:20:00'),

-- Evaluation 44: Homer Favenir - SUMMER Semester 2022-2023
('Homer Favenir', 'SUMMER', '2022-2023', 12, 'Introduction to Programming, Basic Algorithms', 4.333, 4.364, 4.200, 4.250, 4.500, 108, 4.32, 'Reliable instructor with consistent performance. Could modernize teaching materials.', 'no', 'no', '2023-07-15 10:30:00'),

-- Evaluation 45: Fe Antonio - SUMMER Semester 2022-2023
('Fe Antonio', 'SUMMER', '2022-2023', 12, 'Database Administration, SQL Programming', 4.667, 4.909, 4.800, 4.750, 5.000, 121, 4.84, 'Exceptional dedication to student success. Always available for consultation.', 'no', 'yes', '2023-07-18 14:20:00'),

-- Evaluation 46: Val Patrick Fabregas - SUMMER Semester 2022-2023
('Val Patrick Fabregas', 'SUMMER', '2022-2023', 15, 'Mobile App Development, Cross-Platform Programming', 4.667, 4.727, 4.600, 4.500, 5.000, 117, 4.68, 'Knowledgeable and approachable. Provides helpful code reviews.', 'no', 'no', '2023-07-20 09:15:00'),

-- Evaluation 47: Roberto Malitao - SUMMER Semester 2022-2023
('Roberto Malitao', 'SUMMER', '2022-2023', 15, 'Computer Architecture, Digital Logic Design', 4.667, 4.909, 4.800, 4.750, 5.000, 121, 4.84, 'Sets high standards and supports students in achieving them.', 'no', 'yes', '2023-07-22 16:00:00'),

-- Evaluation 48: Luvim Eusebio - SUMMER Semester 2022-2023
('Luvim Eusebio', 'SUMMER', '2022-2023', 15, 'Cybersecurity Fundamentals, Risk Management', 4.667, 4.909, 4.800, 4.750, 5.000, 121, 4.84, 'Brings real-world security scenarios to the classroom effectively.', 'no', 'yes', '2023-07-25 15:45:00'),

-- Evaluation 49: Homer Favenir - 1ST Semester 2023-2024
('Homer Favenir', '1ST', '2023-2024', 21, 'Data Structures, Programming Logic, Computer Fundamentals', 4.333, 4.636, 4.400, 4.500, 4.500, 113, 4.52, 'Solid teaching fundamentals. Room for improvement in student engagement.', 'no', 'no', '2023-11-15 10:30:00'),

-- Evaluation 50: Fe Antonio - 1ST Semester 2023-2024
('Fe Antonio', '1ST', '2023-2024', 18, 'Database Management, Web Development, Systems Analysis', 4.667, 4.727, 4.600, 4.500, 5.000, 117, 4.68, 'Creates an inclusive learning environment. Very thorough in explanations.', 'no', 'no', '2023-11-18 14:20:00'),

-- Evaluation 51: Val Patrick Fabregas - 1ST Semester 2023-2024
('Val Patrick Fabregas', '1ST', '2023-2024', 24, 'Object-Oriented Programming, Mobile Development, Software Engineering', 4.333, 4.545, 4.400, 4.500, 4.000, 111, 4.44, 'Students enjoy the challenging projects and collaborative activities.', 'no', 'no', '2023-11-20 09:15:00'),

-- Evaluation 52: Marco Antonio Subion - 1ST Semester 2023-2024
('Marco Antonio Subion', '1ST', '2023-2024', 18, 'Introduction to Computing, Computer Programming, HCI', 4.333, 4.364, 4.200, 4.250, 4.500, 108, 4.32, 'Makes learning accessible for beginners. Could challenge advanced students more.', 'no', 'no', '2023-11-22 11:45:00'),

-- Evaluation 53: Roberto Malitao - 1ST Semester 2023-2024
('Roberto Malitao', '1ST', '2023-2024', 21, 'Operating Systems, Computer Networks, System Administration', 5.000, 4.727, 4.800, 4.750, 4.500, 119, 4.76, 'Consistently excellent evaluations. A model for other faculty members.', 'no', 'yes', '2023-11-25 16:00:00'),

-- Evaluation 54: Arnold Galve - 1ST Semester 2023-2024
('Arnold Galve', '1ST', '2023-2024', 18, 'Algorithm Design, Data Mining, Artificial Intelligence', 4.333, 4.636, 4.600, 4.500, 4.500, 114, 4.56, 'Provides thorough explanations of advanced AI concepts.', 'no', 'no', '2023-11-28 13:30:00'),

-- Evaluation 55: Edward Cruz - 1ST Semester 2023-2024
('Edward Cruz', '1ST', '2023-2024', 24, 'Discrete Mathematics, Numerical Methods, Statistics', 3.667, 3.909, 3.600, 3.750, 3.500, 94, 3.76, 'Could improve on making abstract mathematical concepts more accessible.', 'no', 'no', '2023-12-01 10:00:00'),

-- Evaluation 56: Luvim Eusebio - 1ST Semester 2023-2024
('Luvim Eusebio', '1ST', '2023-2024', 21, 'Information Security, Ethical Hacking, Cybersecurity', 5.000, 4.909, 5.000, 4.750, 5.000, 123, 4.92, 'Students are inspired by the passion and expertise demonstrated.', 'no', 'yes', '2023-12-03 15:45:00'),

-- Evaluation 57: Rolando Quirong - 1ST Semester 2023-2024
('Rolando Quirong', '1ST', '2023-2024', 18, 'Web Programming, Framework Development, Cloud Computing', 4.333, 4.636, 4.600, 4.500, 4.500, 114, 4.56, 'Good balance of frontend and backend teaching. Practical assessments.', 'no', 'no', '2023-12-05 11:20:00'),

-- Evaluation 58: Homer Favenir - 2ND Semester 2023-2024
('Homer Favenir', '2ND', '2023-2024', 21, 'Algorithm Analysis, Advanced Programming, Software Design', 4.000, 4.273, 4.000, 4.250, 4.000, 104, 4.16, 'Decent hands-on programming exercises. Needs better time management in lectures.', 'no', 'no', '2024-05-10 10:30:00'),

-- Evaluation 59: Fe Antonio - 2ND Semester 2023-2024
('Fe Antonio', '2ND', '2023-2024', 21, 'Software Quality Assurance, Project Management, Capstone', 4.333, 4.636, 4.600, 4.500, 4.500, 114, 4.56, 'Impressive teaching portfolio. Students benefit greatly from hands-on projects.', 'no', 'no', '2024-05-12 14:20:00'),

-- Evaluation 60: Val Patrick Fabregas - 2ND Semester 2023-2024
('Val Patrick Fabregas', '2ND', '2023-2024', 24, 'Advanced Web Technologies, Mobile Development, Software Testing', 4.333, 4.636, 4.600, 4.500, 4.500, 114, 4.56, 'Strong technical skills. Good rapport with students overall.', 'no', 'no', '2024-05-15 09:15:00'),

-- Evaluation 61: Marco Antonio Subion - 2ND Semester 2023-2024
('Marco Antonio Subion', '2ND', '2023-2024', 18, 'Human Computer Interaction, UI/UX Design, Graphics', 4.333, 4.636, 4.400, 4.500, 4.500, 113, 4.52, 'Adequate teaching with room for improvement in engagement techniques.', 'no', 'no', '2024-05-18 11:45:00'),

-- Evaluation 62: Roberto Malitao - 2ND Semester 2023-2024
('Roberto Malitao', '2ND', '2023-2024', 21, 'Computer Architecture, Digital Logic Design, Microprocessors', 5.000, 4.909, 5.000, 4.750, 5.000, 123, 4.92, 'Expert-level instruction with practical real-world applications.', 'no', 'yes', '2024-05-20 16:00:00'),

-- Evaluation 63: Arnold Galve - 2ND Semester 2023-2024
('Arnold Galve', '2ND', '2023-2024', 18, 'Machine Learning, Expert Systems, Data Analytics', 4.333, 4.545, 4.400, 4.500, 4.000, 111, 4.44, 'Well-organized course with relevant assignments and projects.', 'no', 'no', '2024-05-22 13:30:00'),

-- Evaluation 64: Edward Cruz - 2ND Semester 2023-2024
('Edward Cruz', '2ND', '2023-2024', 24, 'Calculus for CS, Linear Algebra, Probability', 3.667, 4.091, 3.800, 3.750, 4.000, 98, 3.92, 'Satisfactory delivery but below expectations for practical application.', 'no', 'no', '2024-05-25 10:00:00'),

-- Evaluation 65: Luvim Eusebio - 2ND Semester 2023-2024
('Luvim Eusebio', '2ND', '2023-2024', 24, 'Network Security, Penetration Testing, Digital Forensics', 4.667, 4.909, 4.800, 4.750, 5.000, 121, 4.84, 'Industry-leading knowledge combined with exceptional pedagogical skills.', 'no', 'yes', '2024-05-28 15:45:00'),

-- Evaluation 66: Rolando Quirong - 2ND Semester 2023-2024
('Rolando Quirong', '2ND', '2023-2024', 21, 'Full Stack Development, DevOps, API Design', 4.333, 4.545, 4.400, 4.500, 4.000, 111, 4.44, 'Well-structured course progression from basics to advanced topics.', 'no', 'no', '2024-05-30 11:20:00'),

-- Evaluation 67: Homer Favenir - SUMMER Semester 2023-2024
('Homer Favenir', 'SUMMER', '2023-2024', 12, 'Introduction to Programming, Basic Algorithms', 4.333, 4.364, 4.200, 4.250, 4.500, 108, 4.32, 'Satisfactory performance. Students suggest more hands-on coding activities.', 'no', 'no', '2024-07-15 10:30:00'),

-- Evaluation 68: Fe Antonio - SUMMER Semester 2023-2024
('Fe Antonio', 'SUMMER', '2023-2024', 12, 'Database Administration, SQL Programming', 4.667, 4.909, 4.800, 4.750, 5.000, 121, 4.84, 'Very professional. Provides excellent support during lab sessions.', 'no', 'yes', '2024-07-18 14:20:00'),

-- Evaluation 69: Val Patrick Fabregas - SUMMER Semester 2023-2024
('Val Patrick Fabregas', 'SUMMER', '2023-2024', 15, 'Mobile App Development, Cross-Platform Programming', 4.667, 4.727, 4.600, 4.500, 5.000, 117, 4.68, 'Effective in teaching complex programming concepts clearly.', 'no', 'no', '2024-07-20 09:15:00'),

-- Evaluation 70: Marco Antonio Subion - SUMMER Semester 2023-2024
('Marco Antonio Subion', 'SUMMER', '2023-2024', 12, 'Introduction to Computing, Computer Programming', 4.000, 4.273, 4.000, 4.250, 4.000, 104, 4.16, 'Satisfactory performance overall. Could improve lecture delivery.', 'no', 'no', '2024-07-22 11:45:00'),

-- Evaluation 71: Roberto Malitao - SUMMER Semester 2023-2024
('Roberto Malitao', 'SUMMER', '2023-2024', 15, 'Computer Architecture, Digital Logic Design', 5.000, 4.727, 4.800, 4.750, 4.500, 119, 4.76, 'Strong fundamentals teaching. Makes difficult concepts accessible.', 'no', 'yes', '2024-07-25 16:00:00'),

-- Evaluation 72: Arnold Galve - SUMMER Semester 2023-2024
('Arnold Galve', 'SUMMER', '2023-2024', 12, 'Introduction to AI, Data Science Basics', 4.667, 4.727, 4.600, 4.500, 5.000, 117, 4.68, 'Creates a stimulating intellectual environment for learning.', 'no', 'no', '2024-07-28 13:30:00'),

-- Evaluation 73: Edward Cruz - SUMMER Semester 2023-2024
('Edward Cruz', 'SUMMER', '2023-2024', 12, 'Research Methods, Technical Writing', 4.000, 4.273, 4.000, 4.250, 4.000, 104, 4.16, 'Students suggest more office hours and review sessions.', 'no', 'no', '2024-08-01 10:00:00'),

-- Evaluation 74: Luvim Eusebio - SUMMER Semester 2023-2024
('Luvim Eusebio', 'SUMMER', '2023-2024', 15, 'Cybersecurity Fundamentals, Risk Management', 5.000, 4.909, 5.000, 4.750, 5.000, 123, 4.92, 'Excellent instructor. Practical industry knowledge shines through.', 'no', 'yes', '2024-08-03 15:45:00'),

-- Evaluation 75: Rolando Quirong - SUMMER Semester 2023-2024
('Rolando Quirong', 'SUMMER', '2023-2024', 12, 'Web Development Basics, HTML/CSS/JavaScript', 4.667, 4.727, 4.600, 4.500, 5.000, 117, 4.68, 'Encourages creativity and innovation in student projects.', 'no', 'no', '2024-08-05 11:20:00');

-- Get the starting evaluation_id for evaluations 26-75
SET @eval_id2 = (SELECT MAX(id) FROM evaluations) - 49;

-- Evaluation Details for Evaluation 26 (Homer Favenir - 1ST 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 5), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 27 (Fe Antonio - 1ST 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 5),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 28 (Val Patrick Fabregas - 1ST 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 29 (Marco Antonio Subion - 1ST 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 4), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 4), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 4), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 30 (Roberto Malitao - 1ST 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 5),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 4), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 31 (Arnold Galve - 1ST 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 32 (Edward Cruz - 1ST 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 3), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 4), (@eval_id2, 'sec2_q2', 4), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 4), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 4), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 4), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 3), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 3), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 33 (Luvim Eusebio - 1ST 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 5),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 5), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 34 (Rolando Quirong - 1ST 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 35 (Homer Favenir - 2ND 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 4), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 4), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 4), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 4), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 4), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 36 (Fe Antonio - 2ND 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 37 (Val Patrick Fabregas - 2ND 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 38 (Marco Antonio Subion - 2ND 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 5), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 39 (Roberto Malitao - 2ND 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 40 (Arnold Galve - 2ND 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 4), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 4), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 41 (Edward Cruz - 2ND 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 4), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 4), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 4), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 4), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 4), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 42 (Luvim Eusebio - 2ND 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 5),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 4), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 43 (Rolando Quirong - 2ND 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 44 (Homer Favenir - SUMMER 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 4), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 4), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 4), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 45 (Fe Antonio - SUMMER 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 5),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 46 (Val Patrick Fabregas - SUMMER 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 47 (Roberto Malitao - SUMMER 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 5),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 48 (Luvim Eusebio - SUMMER 2022-2023)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 5),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 49 (Homer Favenir - 1ST 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 5), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 50 (Fe Antonio - 1ST 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 51 (Val Patrick Fabregas - 1ST 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 4), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 4), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 52 (Marco Antonio Subion - 1ST 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 4), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 4), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 4), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 53 (Roberto Malitao - 1ST 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 54 (Arnold Galve - 1ST 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 55 (Edward Cruz - 1ST 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 3), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 4), (@eval_id2, 'sec2_q2', 4), (@eval_id2, 'sec2_q3', 3),
(@eval_id2, 'sec2_q4', 4), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 4),
(@eval_id2, 'sec2_q7', 3), (@eval_id2, 'sec2_q8', 4), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 4), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 3), (@eval_id2, 'sec3_q3', 3),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 3), (@eval_id2, 'sec4_q3', 4), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 3);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 56 (Luvim Eusebio - 1ST 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 5),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 4), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 57 (Rolando Quirong - 1ST 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 58 (Homer Favenir - 2ND 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 4), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 4), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 4), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 4), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 4), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 59 (Fe Antonio - 2ND 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 60 (Val Patrick Fabregas - 2ND 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 61 (Marco Antonio Subion - 2ND 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 5), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 62 (Roberto Malitao - 2ND 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 5),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 4), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 63 (Arnold Galve - 2ND 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 4), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 4), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 64 (Edward Cruz - 2ND 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 3), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 4), (@eval_id2, 'sec2_q2', 4), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 4), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 4), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 4), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 3), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 3), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 65 (Luvim Eusebio - 2ND 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 5),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 66 (Rolando Quirong - 2ND 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 4), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 4), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 67 (Homer Favenir - SUMMER 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 4), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 4), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 4), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 68 (Fe Antonio - SUMMER 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 5),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 69 (Val Patrick Fabregas - SUMMER 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 70 (Marco Antonio Subion - SUMMER 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 4), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 4), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 4), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 4), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 4), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 71 (Roberto Malitao - SUMMER 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 72 (Arnold Galve - SUMMER 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 73 (Edward Cruz - SUMMER 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 4), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 4),
(@eval_id2, 'sec2_q1', 4), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 4), (@eval_id2, 'sec2_q5', 4), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 4), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 4), (@eval_id2, 'sec2_q11', 4),
(@eval_id2, 'sec3_q1', 4), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 4),
(@eval_id2, 'sec3_q4', 4), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 4), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 4), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 4), (@eval_id2, 'sec5_q2', 4);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 74 (Luvim Eusebio - SUMMER 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 5), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 5),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 5),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 5), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 5),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 5), (@eval_id2, 'sec4_q3', 4), (@eval_id2, 'sec4_q4', 5),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

SET @eval_id2 = @eval_id2 + 1;
-- Evaluation Details for Evaluation 75 (Rolando Quirong - SUMMER 2023-2024)
INSERT INTO `evaluation_details` (`evaluation_id`, `question_code`, `rating`) VALUES
(@eval_id2, 'sec1_q1', 5), (@eval_id2, 'sec1_q2', 4), (@eval_id2, 'sec1_q3', 5),
(@eval_id2, 'sec2_q1', 5), (@eval_id2, 'sec2_q2', 5), (@eval_id2, 'sec2_q3', 4),
(@eval_id2, 'sec2_q4', 5), (@eval_id2, 'sec2_q5', 5), (@eval_id2, 'sec2_q6', 5),
(@eval_id2, 'sec2_q7', 4), (@eval_id2, 'sec2_q8', 5), (@eval_id2, 'sec2_q9', 4),
(@eval_id2, 'sec2_q10', 5), (@eval_id2, 'sec2_q11', 5),
(@eval_id2, 'sec3_q1', 5), (@eval_id2, 'sec3_q2', 4), (@eval_id2, 'sec3_q3', 5),
(@eval_id2, 'sec3_q4', 5), (@eval_id2, 'sec3_q5', 4),
(@eval_id2, 'sec4_q1', 5), (@eval_id2, 'sec4_q2', 4), (@eval_id2, 'sec4_q3', 5), (@eval_id2, 'sec4_q4', 4),
(@eval_id2, 'sec5_q1', 5), (@eval_id2, 'sec5_q2', 5);

