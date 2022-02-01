
CREATE TABLE `tblreservation` (
  `reserveid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `tableid` int(11) NOT NULL,
  `reservetime` time NOT NULL,
  `reserveday` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=free,2=booked',
  PRIMARY KEY (`reserveid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





