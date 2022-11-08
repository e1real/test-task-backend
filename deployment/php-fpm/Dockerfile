FROM phpdockerio/php:8.1-fpm
WORKDIR "/app"

RUN apt-get update; apt-get install -y wget;
RUN wget -O "/usr/local/bin/go-replace" "https://github.com/webdevops/goreplace/releases/download/1.1.2/gr-arm64-linux"; \
        chmod +x "/usr/local/bin/go-replace"; \
        "/usr/local/bin/go-replace" --version;
RUN apt-get -y --no-install-recommends install \
        php8.1-mysql \
        php8.1-sqlite \
        php8.1-psr \
        php8.1-redis; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*



