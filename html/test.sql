SELECT idReservation,Reservecode FROM Reservation WHERE idRegistereduser=29 ORDER BY idReservation DESC LIMIT 1;
SELECT idReservation,MAX(TimeStemp),Reservecode FROM Reservation WHERE idRegistereduser=(SELECT DISTINCT idRegistereduser FROM registereduser WHERE RegisteredEmailaddress='boromil@gmail.com') ORDER BY idReservation DESC LIMIT 1;
