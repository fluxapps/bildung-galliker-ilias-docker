# syntax=docker/dockerfile:1
FROM fluxfw/flux-ilias-ilias-base:php7.4 AS ilias
RUN /flux-ilias-ilias-base/bin/install-ilias-core.sh 7.17

# Setup java 8 in ilias container because the certificate plugin generates the certificates via jasper reports.
RUN apk add --no-cache libretls musl-locales musl-locales-lang tzdata zlib fontconfig ttf-dejavu \
    && rm -rf /var/cache/apk/*
ENV JAVA_HOME=/opt/java/openjdk
ENV LANG=en_US.UTF-8 LANGUAGE=en_US:en LC_ALL=en_US.UTF-8

COPY --from=eclipse-temurin:8u332-b09-jre-alpine $JAVA_HOME $JAVA_HOME
ENV PATH="${JAVA_HOME}/bin:${PATH}"

COPY ./skin_galliker_ilias_7 /var/www/html/Customizing/global/skin/skin_galliker_ilias_7

# Plugin UserTakeOver
RUN /flux-ilias-ilias-base/bin/install-archive.sh https://github.com/srsolutionsag/UserTakeOver/archive/aefb7b18790e60e748bb4726ab116fe64b2a48cc.tar.gz /var/www/html/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/UserTakeOver
# Plugin SrLearningProgressPDBlock
RUN /flux-ilias-ilias-base/bin/install-archive.sh https://github.com/fluxfw/SrLearningProgressPDBlock/archive/refs/tags/v1.6.0.tar.gz /var/www/html/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/SrLearningProgressPDBlock
# Plugin Certificate
RUN /flux-ilias-ilias-base/bin/install-archive.sh https://github.com/fluxapps/Certificate/archive/refs/heads/main.tar.gz /var/www/html/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/Certificate
# Plugin CertificateCron
RUN /flux-ilias-ilias-base/bin/install-archive.sh https://github.com/fluxapps/CertificateCron/archive/refs/heads/main.tar.gz /var/www/html/Customizing/global/plugins/Services/Cron/CronHook/CertificateCron


FROM fluxfw/flux-ilias-nginx-base:latest AS nginx
COPY --from=ilias /var/www/html /var/www/html