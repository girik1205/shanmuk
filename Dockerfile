FROM ubuntu
MAINTAINER gireesh "gireesh.k@cartrade.com"
RUN useradd -p redhat123 demoDock
USER demoDock
RUN id
USER root
WORKDIR /tmp
ADD http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf /tmp
VOLUME /work
ONBUILD RUN mkdir /tmp/tempo
RUN apt-get update
RUN apt-get install -y nginx
ENV CONTAINER_NAME DemoContainer
CMD ["/usr/sbin/nginx", "-g", "daemon off;"]
EXPOSE 80
