# syntax=docker/dockerfile:1
FROM fluxfw/flux-ilias-ilias-base:php7.4 AS ilias
RUN apk add --no-cache openjdk8-jre
RUN /flux-ilias-ilias-base/bin/install-ilias-core.sh 7.17

# flux-ilias-rest
RUN /flux-ilias-ilias-base/bin/install-flux-ilias-rest-api.sh v2023-01-03-1
RUN /flux-ilias-ilias-base/bin/install-flux-ilias-rest-helper-plugin.sh v2022-12-12-1
RUN /flux-ilias-ilias-base/bin/install-flux-ilias-rest-object-helper-plugin.sh v2022-12-12-1

# Galliker Skin
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
RUN /flux-ilias-nginx-base/bin/install-flux-ilias-rest-api.sh