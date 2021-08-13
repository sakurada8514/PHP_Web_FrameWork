FROM mysql/mysql-server:8.0

ENV MYSQL_DATABASE=test_local \
  MYSQL_USER=sakurada \
  MYSQL_PASSWORD=sakurada \
  MYSQL_ROOT_PASSWORD=sakurada \
  TZ=Asia/Tokyo

COPY ./my.cnf /etc/my.cnf
RUN chmod 644 /etc/my.cnf