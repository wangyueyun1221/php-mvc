USE demo;

DROP TABLE IF EXISTS `db_demo`;

CREATE TABLE `db_demo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '姓名',
  `sex` enum('male','female') NOT NULL DEFAULT 'male' COMMENT '性别',
  `age` int(11) NOT NULL DEFAULT '0' COMMENT '年龄',
  `description` varchar(300) NOT NULL DEFAULT '' COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `db_demo` (`id`, `name`, `sex`, `age`, `description`)
VALUES
    (1, '张三', 'male', 20, '我叫张三'),
    (2, '李四', 'male', 21, '我叫李四'),
    (3, '王五', 'male', 19, '我叫王五');
