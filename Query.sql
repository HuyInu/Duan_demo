SET @getdate =  '2023-09-01';
SET @idloaivang = 29; 

SELECT SUM(cannangvh), SUM(cannangh), SUM(cannangv) from khonguonvao_khoachinct 
WHERE idloaivang = @idloaivang and `type`=2 and typevkc=1 and dated >= @getdate AND dated <= DATE_FORMAT(LAST_DAY(@getdate), '%Y-%m-%d');

SELECT SUM(cannangvh), SUM(cannangh), SUM(cannangv) from khonguonvao_khoachinct 
WHERE idloaivang = @idloaivang and `type`=2 AND trangthai=2 and typevkc=1 and datedxuat >= @getdate AND datedxuat <= DATE_FORMAT(LAST_DAY(@getdate), '%Y-%m-%d');

SELECT SUM(cannangvh), SUM(cannangh), SUM(cannangv) from khonguonvao_khoachinct 
WHERE idloaivang = @idloaivang and `type`=2 AND trangthai=0 and typevkc=1 and dated >= @getdate AND dated <= DATE_FORMAT(LAST_DAY(@getdate), '%Y-%m-%d');