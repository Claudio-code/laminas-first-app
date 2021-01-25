docker-compose up --build -d

docker exec -it learning-laminas-mvc bash -c "chmod 777 -R data"

docker exec -it learning-laminas-database bash -c 'mysql -u root "-pEstudar+-mais321" --execute="CREATE DATABASE IF NOT EXISTS laminas_test;"'