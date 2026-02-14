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
