(this.webpackJsonp=this.webpackJsonp||[]).push([[16],{UF5r:function(e,a,n){"use strict";n.r(a);var l=n("aTAw"),i=n.n(l);const{Component:d}=Shopware;d.register("swag-migration-profile-ownProfile-local-credential-form",{template:i.a,props:{credentials:{type:Object,default:()=>({})}},data:()=>({inputCredentials:{dbHost:"",dbPort:"3306",dbUser:"",dbPassword:"",dbName:""}}),watch:{credentials:{immediate:!0,handler(e){null!==e?(this.inputCredentials=e,this.emitOnChildRouteReadyChanged(this.areCredentialsValid(this.inputCredentials))):this.emitCredentials(this.inputCredentials)}},inputCredentials:{deep:!0,handler(e){this.emitCredentials(e)}}},methods:{areCredentialsValid:e=>""!==e.dbHost&&""!==e.dbPort&&""!==e.dbName&&""!==e.dbUser&&""!==e.dbPassword,emitOnChildRouteReadyChanged(e){this.$emit("onChildRouteReadyChanged",e)},emitCredentials(e){this.$emit("onCredentialsChanged",e),this.emitOnChildRouteReadyChanged(this.areCredentialsValid(e))},onKeyPressEnter(){this.$emit("onTriggerPrimaryClick")}}})},aTAw:function(e,a){e.exports='{% block own_profile_page_credentials %}\n    <div class="swag-migration-wizard swag-migration-wizard-page-credentials"\n         @keypress.enter="onKeyPressEnter">\n        {% block own_profile_page_credentials_content %}\n            <div class="swag-migration-wizard__content">\n                {% block own_profile_page_credentials_information %}\n                    <div class="swag-migration-wizard__content-information">\n                        {% block own_profile_page_credentials_local_hint %}\n                            {{ $tc(\'swag-migration.wizard.pages.credentials.shopware55.local.contentInformation\') }}\n                        {% endblock %}\n                    </div>\n                {% endblock %}\n\n                {% block own_profile_page_credentials_credentials %}\n                    <div class="swag-migration-wizard__form">\n                        {% block own_profile_page_credentials_local_db_host_port_group %}\n                            <sw-container columns="1fr 80px"\n                                          gap="16px">\n                                {% block own_profile_page_credentials_local_dbhost_field %}\n                                    <sw-text-field v-autofocus\n                                                   name="sw-field--dbHost"\n                                                   :label="$tc(\'swag-migration.wizard.pages.credentials.shopware55.local.dbHostLabel\')"\n                                                   :placeholder="$tc(\'swag-migration.wizard.pages.credentials.shopware55.local.dbHostPlaceholder\')"\n                                                   v-model="inputCredentials.dbHost">\n                                    </sw-text-field>\n                                {% endblock %}\n\n                                {% block own_profile_page_credentials_local_dbport_field %}\n                                    <sw-field name="sw-field--dbPort"\n                                              :label="$tc(\'swag-migration.wizard.pages.credentials.shopware55.local.dbPortLabel\')"\n                                              v-model="inputCredentials.dbPort">\n                                    </sw-field>\n                                {% endblock %}\n                            </sw-container>\n                        {% endblock %}\n\n                        {% block own_profile_page_credentials_local_dbuser_field %}\n                            <sw-field name="sw-field--dbUser"\n                                      :label="$tc(\'swag-migration.wizard.pages.credentials.shopware55.local.dbUserLabel\')"\n                                      :placeholder="$tc(\'swag-migration.wizard.pages.credentials.shopware55.local.dbUserPlaceholder\')"\n                                      v-model="inputCredentials.dbUser">\n                            </sw-field>\n                        {% endblock %}\n\n                        {% block own_profile_page_credentials_local_dbpassword_field %}\n                            <sw-field name="sw-field--dbPassword"\n                                      type="password"\n                                      :label="$tc(\'swag-migration.wizard.pages.credentials.shopware55.local.dbPasswordLabel\')"\n                                      :placeholder="$tc(\'swag-migration.wizard.pages.credentials.shopware55.local.dbPasswordPlaceholder\')"\n                                      v-model="inputCredentials.dbPassword">\n                            </sw-field>\n                        {% endblock %}\n\n                        {% block own_profile_page_credentials_local_dbname_field %}\n                            <sw-field name="sw-field--dbName"\n                                      :label="$tc(\'swag-migration.wizard.pages.credentials.shopware55.local.dbNameLabel\')"\n                                      :placeholder="$tc(\'swag-migration.wizard.pages.credentials.shopware55.local.dbNamePlaceholder\')"\n                                      v-model="inputCredentials.dbName">\n                            </sw-field>\n                        {% endblock %}\n                    </div>\n                {% endblock %}\n            </div>\n        {% endblock %}\n    </div>\n{% endblock %}'}},[["UF5r",0]]]);