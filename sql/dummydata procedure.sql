DELIMITER $$
DROP PROCEDURE IF EXISTS loopInsert$$

CREATE PROCEDURE loopInsert()
BEGIN
    DECLARE i INT DEFAULT 1;
    WHILE i <= 202 DO /*더미데이터 갯수*/
        INSERT INTO post(title , content, date, hit, recommend_Y, recommend_N,writer_id)
          VALUES(concat('제목',i), concat('내용',i), now(), 0, 0, 0,'jay');
        SET i = i + 1;
    END WHILE;
END$$
DELIMITER $$

call loopInsert();
select * from post