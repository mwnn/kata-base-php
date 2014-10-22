CREATE TABLE Counter
(
  id INTEGER PRIMARY KEY,
  propertyType  VARCHAR(32),
  propertyValue VARCHAR(64),
  counter int(11),
  ts_create TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  ts_expiry TIMESTAMP NOT NULL
);
