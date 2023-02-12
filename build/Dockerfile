# syntax=docker/dockerfile:1
FROM fluxfw/flux-ilias-ilias-base:php7.4 AS ilias
RUN apk add --no-cache openjdk8-jre
RUN /flux-ilias-ilias-base/bin/install-ilias-core.sh 7.18
# PDF Generation
RUN /flux-ilias-ilias-base/bin/install-wkhtmltopdf.sh
COPY --from=surnet/alpine-wkhtmltopdf:3.16.2-0.12.6-small /bin/wkhtmltopdf /usr/local/bin/wkhtmltopdf
# flux-ilias-rest
#RUN /flux-ilias-ilias-base/bin/install-flux-ilias-rest-api.sh v2023-01-03-1
#RUN /flux-ilias-ilias-base/bin/install-flux-ilias-rest-helper-plugin.sh v2022-12-12-1
#RUN /flux-ilias-ilias-base/bin/install-flux-ilias-rest-object-helper-plugin.sh v2022-12-12-1
# Galliker Customizing
COPY ./Customizing /var/www/html/Customizing
# Galliker cert_templates
COPY ./cert_templates /var/iliasdata/default/cert_templates
# Galliker patches
COPY ./patches/class.ilPDSelectedItemsBlockMembershipsProvider.php /var/www/html/Services/Dashboard/ItemsBlock/classes/class.ilPDSelectedItemsBlockMembershipsProvider.php
# Galliker plugin/IQSoftEvent
COPY ./plugins/IQSoftEvent /var/www/html/Customizing/global/plugins/Services/EventHandling/EventHook/IQSoftEvent
# Plugin UserTakeOver
RUN /flux-ilias-ilias-base/bin/install-archive.sh https://github.com/srsolutionsag/UserTakeOver/archive/aefb7b18790e60e748bb4726ab116fe64b2a48cc.tar.gz /var/www/html/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/UserTakeOver
# Plugin SrLearningProgressPDBlock
RUN /flux-ilias-ilias-base/bin/install-archive.sh https://github.com/fluxfw/SrLearningProgressPDBlock/archive/refs/tags/v1.6.0.tar.gz /var/www/html/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/SrLearningProgressPDBlock
# Plugin Certificate
RUN /flux-ilias-ilias-base/bin/install-archive.sh https://github.com/fluxapps/Certificate/archive/refs/tags/v2023-02-06-1.tar.gz /var/www/html/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/Certificate
# Plugin CertificateCron
RUN /flux-ilias-ilias-base/bin/install-archive.sh https://github.com/fluxapps/CertificateCron/archive/refs/tags/v2023-02-06-1.tar.gz /var/www/html/Customizing/global/plugins/Services/Cron/CronHook/CertificateCron
# Plugin Hub2
RUN /flux-ilias-ilias-base/bin/install-archive.sh https://github.com/mstuder/Hub2/archive/refs/tags/2022-01-26_patch_release_auth_oidc.tar.gz /var/www/html/Customizing/global/plugins/Services/Cron/CronHook/Hub2

FROM fluxfw/flux-ilias-nginx-base:latest AS nginx
COPY --from=ilias /var/www/html /var/www/html
#RUN /flux-ilias-nginx-base/bin/install-flux-ilias-rest-api.sh