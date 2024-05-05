/*
 Navicat Premium Data Transfer

 Source Server         : koneksi01
 Source Server Type    : MySQL
 Source Server Version : 100427 (10.4.27-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : tp_mvc

 Target Server Type    : MySQL
 Target Server Version : 100427 (10.4.27-MariaDB)
 File Encoding         : 65001

 Date: 05/05/2024 12:39:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `join_date` date NULL DEFAULT NULL,
  `status_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `status_id`(`status_id` ASC) USING BTREE,
  CONSTRAINT `member_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `membershipstatus` (`status_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES (1, 'Kang Sae-byeok', 'kangsaebyeok@naver.com', '010-1234-5678', '2024-01-01', 2);
INSERT INTO `member` VALUES (2, 'Nam Seon-ho', 'namseonho@google.com', '010-2345-6789', '2023-05-15', 1);
INSERT INTO `member` VALUES (3, 'Jeon Yeo-bin', 'jeonyeobin@yahoo.com', '010-3456-7890', '2022-11-20', 1);
INSERT INTO `member` VALUES (4, 'Lee Dong-hwi', 'leedonghwi@naver.com', '010-4567-8901', '2023-09-10', 1);
INSERT INTO `member` VALUES (5, 'Ahn Eun-jin', 'ahneunjin@google.com', '010-5678-9012', '2024-03-08', 1);

-- ----------------------------
-- Table structure for membershipstatus
-- ----------------------------
DROP TABLE IF EXISTS `membershipstatus`;
CREATE TABLE `membershipstatus`  (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`status_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of membershipstatus
-- ----------------------------
INSERT INTO `membershipstatus` VALUES (1, 'Active', 'Membership is currently active');
INSERT INTO `membershipstatus` VALUES (2, 'Inactive', 'Membership is currently inactive');
INSERT INTO `membershipstatus` VALUES (3, 'Pending', 'Membership is pending for approval');
INSERT INTO `membershipstatus` VALUES (4, 'Suspended', 'Membership is temporarily suspended');
INSERT INTO `membershipstatus` VALUES (5, 'Cancelled', 'Membership has been cancelled');
-- ----------------------------
-- Table structure for membershipsubscription
-- ----------------------------
DROP TABLE IF EXISTS `membershipsubscription`;
CREATE TABLE `membershipsubscription`  (
  `subscription_id` int NOT NULL AUTO_INCREMENT,
  `member_id` int NULL DEFAULT NULL,
  `subscription_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `start_date` date NULL DEFAULT NULL,
  `end_date` date NULL DEFAULT NULL,
  `payment_method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`subscription_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of membershipsubscription
-- ----------------------------
INSERT INTO `membershipsubscription` VALUES (1, 2, 'Basic', '2022-01-03', '2025-04-06', 'PayPal');
INSERT INTO `membershipsubscription` VALUES (2, 3, 'Basic', '2024-03-10', '2025-03-10', 'Credit Card');
INSERT INTO `membershipsubscription` VALUES (3, 4, 'Plus', '2024-04-20', '2025-04-20', 'Bank Transfer');
INSERT INTO `membershipsubscription` VALUES (4, 5, 'Platinum', '2024-05-05', '2025-05-05', 'PayPal');

SET FOREIGN_KEY_CHECKS = 1;
