## Running setup

1. Make external volume
docker-volumne create --name [volumen_name]

2. Make external network

3. Run docker-compose
docker-compose -f s2i/docker-compose.yml up [-d]

4. Access application
https://<host>:8080/api/<api>
