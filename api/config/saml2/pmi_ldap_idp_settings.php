<?php

// If you choose to use ENV vars to define these values, give this IdP its own env var names
// so you can define different values for each IdP, all starting with 'SAML2_'.$this_idp_env_id
$this_idp_env_id = 'pmi_ldap';

//This is variable is for simplesaml example only.
// For real IdP, you must set the url values in the 'idp' config to conform to the IdP's real urls.
$idp_host = env('SAML2_' . $this_idp_env_id . '_IDP_HOST', 'http://localhost:8000/simplesaml');

return $settings = array(

    /*****
     * One Login Settings
     */

    // If 'strict' is True, then the PHP Toolkit will reject unsigned
    // or unencrypted messages if it expects them signed or encrypted
    // Also will reject the messages if not strictly follow the SAML
    // standard: Destination, NameId, Conditions ... are validated too.
    'strict' => true, //@todo: make this depend on laravel config

    // Enable debug mode (to print errors)
    'debug' => true, // env('APP_DEBUG', false),

    // Service Provider Data that we are deploying
    'sp' => array(

        // Specifies constraints on the name identifier to be used to
        // represent the requested subject.
        // Take a look on lib/Saml2/Constants.php to see the NameIdFormat supported
        'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent',

        // Usually x509cert and privateKey of the SP are provided by files placed at
        // the certs folder. But we can also provide them with the following parameters
        'x509cert' => env('SAML2_' . $this_idp_env_id . '_SP_x509', ''),
        'privateKey' => env('SAML2_' . $this_idp_env_id . '_SP_PRIVATEKEY', ''),

        // Identifier (URI) of the SP entity.
        // Leave blank to use the '{idpName}_metadata' route, e.g. 'test_metadata'.
        'entityId' => env('SAML2_' . $this_idp_env_id . '_SP_ENTITYID', ''),

        // Specifies info about where and how the <AuthnResponse> message MUST be
        // returned to the requester, in this case our SP.
        'assertionConsumerService' => array(
            // URL Location where the <Response> from the IdP will be returned,
            // using HTTP-POST binding.
            // Leave blank to use the '{idpName}_acs' route, e.g. 'test_acs'
            'url' => '',
        ),
        // Specifies info about where and how the <Logout Response> message MUST be
        // returned to the requester, in this case our SP.
        // Remove this part to not include any URL Location in the metadata.
        'singleLogoutService' => array(
            // URL Location where the <Response> from the IdP will be returned,
            // using HTTP-Redirect binding.
            // Leave blank to use the '{idpName}_sls' route, e.g. 'test_sls'
            'url' => '',
        ),
    ),

    // Identity Provider Data that we want connect with our SP
    'idp' => array(
        // Identifier of the IdP entity  (must be a URI)
        'entityId' => 'https://stsqa.pmiapps.biz/adfs/services/trust',
        // 'entityId' => env('SAML2_'.$this_idp_env_id.'_IDP_ENTITYID', $idp_host . '/saml2/idp/metadata.php'),
        // SSO endpoint info of the IdP. (Authentication Request protocol)
        'singleSignOnService' => array(
            // URL Target of the IdP where the SP will send the Authentication Request Message,
            // using HTTP-Redirect binding.
            'url' => 'https://stsqa.pmiapps.biz/adfs/ls/',
            // 'url' => env('SAML2_' . $this_idp_env_id . '_IDP_SSO_URL', $idp_host . '/saml2/idp/SSOService.php'),
        ),
        // SLO endpoint info of the IdP.
        'singleLogoutService' => array(
            // URL Location of the IdP where the SP will send the SLO Request,
            // using HTTP-Redirect binding.
            'url' => 'https://stsqa.pmiapps.biz/adfs/ls/',
            // 'url' => env('SAML2_' . $this_idp_env_id . '_IDP_SL_URL', $idp_host . '/saml2/idp/SingleLogoutService.php'),
        ),
        // Public x509 certificate of the IdP
        // 'x509cert' => env('SAML2_' . $this_idp_env_id . '_IDP_x509', 'MIID/TCCAuWgAwIBAgIJAI4R3WyjjmB1MA0GCSqGSIb3DQEBCwUAMIGUMQswCQYDVQQGEwJBUjEVMBMGA1UECAwMQnVlbm9zIEFpcmVzMRUwEwYDVQQHDAxCdWVub3MgQWlyZXMxDDAKBgNVBAoMA1NJVTERMA8GA1UECwwIU2lzdGVtYXMxFDASBgNVBAMMC09yZy5TaXUuQ29tMSAwHgYJKoZIhvcNAQkBFhFhZG1pbmlAc2l1LmVkdS5hcjAeFw0xNDEyMDExNDM2MjVaFw0yNDExMzAxNDM2MjVaMIGUMQswCQYDVQQGEwJBUjEVMBMGA1UECAwMQnVlbm9zIEFpcmVzMRUwEwYDVQQHDAxCdWVub3MgQWlyZXMxDDAKBgNVBAoMA1NJVTERMA8GA1UECwwIU2lzdGVtYXMxFDASBgNVBAMMC09yZy5TaXUuQ29tMSAwHgYJKoZIhvcNAQkBFhFhZG1pbmlAc2l1LmVkdS5hcjCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAMbzW/EpEv+qqZzfT1Buwjg9nnNNVrxkCfuR9fQiQw2tSouS5X37W5h7RmchRt54wsm046PDKtbSz1NpZT2GkmHN37yALW2lY7MyVUC7itv9vDAUsFr0EfKIdCKgxCKjrzkZ5ImbNvjxf7eA77PPGJnQ/UwXY7W+cvLkirp0K5uWpDk+nac5W0JXOCFR1BpPUJRbz2jFIEHyChRt7nsJZH6ejzNqK9lABEC76htNy1Ll/D3tUoPaqo8VlKW3N3MZE0DB9O7g65DmZIIlFqkaMH3ALd8adodJtOvqfDU/A6SxuwMfwDYPjoucykGDu1etRZ7dF2gd+W+1Pn7yizPT1q8CAwEAAaNQME4wHQYDVR0OBBYEFPsn8tUHN8XXf23ig5Qro3beP8BuMB8GA1UdIwQYMBaAFPsn8tUHN8XXf23ig5Qro3beP8BuMAwGA1UdEwQFMAMBAf8wDQYJKoZIhvcNAQELBQADggEBAGu60odWFiK+DkQekozGnlpNBQz5lQ/bwmOWdktnQj6HYXu43e7sh9oZWArLYHEOyMUekKQAxOK51vbTHzzw66BZU91/nqvaOBfkJyZKGfluHbD0/hfOl/D5kONqI9kyTu4wkLQcYGyuIi75CJs15uA03FSuULQdY/Liv+czS/XYDyvtSLnu43VuAQWN321PQNhuGueIaLJANb2C5qq5ilTBUw6PxY9Z+vtMjAjTJGKEkE/tQs7CvzLPKXX3KTD9lIILmX5yUC3dLgjVKi1KGDqNApYGOMtjr5eoxPQrqDBmyx3flcy0dQTdLXud3UjWVW3N0PYgJtw5yBsS74QTGD4='),
        'x509cert' => '',
        /*
         *  Instead of use the whole x509cert you can use a fingerprint
         *  (openssl x509 -noout -fingerprint -in "idp.crt" to generate it)
         */
        // 'certFingerprint' => '',
        // 'certFingerprintAlgorithm' => 'sha1',

        /* In some scenarios the IdP uses different certificates for
         * signing/encryption, or is under key rollover phase and more
         * than one certificate is published on IdP metadata.
         * In order to handle that the toolkit offers that parameter.
         * (when used, 'x509cert' and 'certFingerprint' values are
         * ignored).
         */
        'x509certMulti' => array(
             'signing' => array(
                 0 => 'MIIC3jCCAcagAwIBAgIQWQ9jr4GY4ItLoNRKSJn4lzANBgkqhkiG9w0BAQsFADArMSkwJwYDVQQDEyBBREZTIFNpZ25pbmcgLSBzdHNxYS5wbWlhcHBzLmJpejAeFw0xNTExMTcxODMxNTNaFw0yMDExMTUxODMxNTNaMCsxKTAnBgNVBAMTIEFERlMgU2lnbmluZyAtIHN0c3FhLnBtaWFwcHMuYml6MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmTP2lFo7xascqj9tICBFeFgbtw4iK8PhhJ1pwYSBClXxgBXetlU3AbMXLxw+VhvXt5hxJL/t3lEmzlxBVRdortIjgtrFf7ei+HU2gGHbdApehko0aQa4DNih6w+6vUdo76A+bBfm3HgPdsoMhkbczJrgrCayqQWojdcbWitIZY6+6lJ1WeqX4aTdAuxJLG4pCMn+UJIGPmh+28k1vXrLuogVqlke1v0FKrCJ9SEXldiTQfGwhQqF4JHwQe4Xe4U7tcn51bULnKaHODUvDe3N8kE9fWs5Wsy4mnTgQ6ikQnuF2Upm5DiVuKBGsM1hB1EOFEbCtGlNpIB7S7q8UyTDywIDAQABMA0GCSqGSIb3DQEBCwUAA4IBAQAqdA0y+L2ACMAF8Yh4e3nZFmBycLhHChP1pT2WlUfKNputePV1HYT0cXi2HT1iKDxp91+lDPvo5jVyQTjCFeaDaHwkQ4aOZ8wnkqx868AOS7g2UJA3DRy7STHn20BRNsL8FeZyCcCI+qlRVuDLe1hRiEgw/5q8x2ZaQdxyqArOhF33LvGQ56h1LVTsdrYkSc+w5FsScEf0SXglMJ+PbR3RL9zipV1OkBHUx5WM+U4YZMZlOk4Jy6140KWh26YStbvaeKRg4gD7h6hkCinZBQ4Z81iyjYMVIbEsu78h5ZBWG6oqL4aSFnY1uKjLi7a/Xa/6Yyeb7GMgBNcqZfI4+dO5',
             ),
             'encryption' => array(
                 0 => 'MIIC5DCCAcygAwIBAgIQTNhPpIa63aJDoZvp8vG5BDANBgkqhkiG9w0BAQsFADAuMSwwKgYDVQQDEyNBREZTIEVuY3J5cHRpb24gLSBzdHNxYS5wbWlhcHBzLmJpejAeFw0xNTExMTcxODMxNTJaFw0yMDExMTUxODMxNTJaMC4xLDAqBgNVBAMTI0FERlMgRW5jcnlwdGlvbiAtIHN0c3FhLnBtaWFwcHMuYml6MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4qUKcKhkJsGL6DJeS1ymaWhHdHexUvz3Mh29/kzTKh2L6EO3Z4nNY9L6p99fDjhlqMdB9kNXTzglj6oZ+ohh8AhEHlLSrnR0x+RLXBzQaiejFCM4Li+kObUYuCzSDJQr3DgWF6ocxx1RZGV7aIJ2qyF3hvhYOVoO8kzOf9HQApAM53hZLpdVWp7t3y3rFVceWzq9pzkiILJeu4csJGS8IY2iEjDsc/FEHwK7R734IQl/FMGMy/CPjWDsTLK4AQmDBbrjltKs10QwMKlgjWIEYUnXEyeRCf6N83pfeQnOA+gSusr7xcrn0CSxhjfA2ppJ6KuM3iqxc0rHmrGU7cTUaQIDAQABMA0GCSqGSIb3DQEBCwUAA4IBAQAb3I5JGi5uEMJrKvF2VVXTCLAlMP2wRXm0EKdGWTQecKZ0w4zcXA3gO57k+MUVAdJpHEp0Z3IJSwHegqbtIEDrA5coI2X7zi+0PtYDXkr+wjAcG4hMPYuA9Ho4OALxvJhBEl8HKTzm/iaRDyj7IntmkzexyqiG+b63ro+sBmOBP6j09cmCuJJmE582X9W8Vf13pJ3VF/y7f1RLbozjftIoxno6p3VVvzOf+q5vi7ApEhlkI7KC4RFHCUBUEAPGB9DryV8NQiam0K7kbMZj5fw5OLWOWzJScPALRsMHNuJHKA4vCBmvyFfpjdibJGlfwdJUG7thPyVO0n5iv/ITu2ur',
             )
        ),
    ),



    /***
     *
     *  OneLogin advanced settings
     *
     *
     */
    // Security settings
    'security' => array(

        /** signatures and encryptions offered */

        // Indicates that the nameID of the <samlp:logoutRequest> sent by this SP
        // will be encrypted.
        'nameIdEncrypted' => false,

        // Indicates whether the <samlp:AuthnRequest> messages sent by this SP
        // will be signed.              [The Metadata of the SP will offer this info]
        'authnRequestsSigned' => false,

        // Indicates whether the <samlp:logoutRequest> messages sent by this SP
        // will be signed.
        'logoutRequestSigned' => false,

        // Indicates whether the <samlp:logoutResponse> messages sent by this SP
        // will be signed.
        'logoutResponseSigned' => false,

        /* Sign the Metadata
        False || True (use sp certs) || array (
                                                    keyFileName => 'metadata.key',
                                                    certFileName => 'metadata.crt'
                                                )
        */
        'signMetadata' => false,


        /** signatures and encryptions required **/

        // Indicates a requirement for the <samlp:Response>, <samlp:LogoutRequest> and
        // <samlp:LogoutResponse> elements received by this SP to be signed.
        'wantMessagesSigned' => false,

        // Indicates a requirement for the <saml:Assertion> elements received by
        // this SP to be signed.        [The Metadata of the SP will offer this info]
        'wantAssertionsSigned' => false,

        // Indicates a requirement for the NameID received by
        // this SP to be encrypted.
        'wantNameIdEncrypted' => false,

        // Authentication context.
        // Set to false and no AuthContext will be sent in the AuthNRequest,
        // Set true or don't present thi parameter and you will get an AuthContext 'exact' 'urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport'
        // Set an array with the possible auth context values: array ('urn:oasis:names:tc:SAML:2.0:ac:classes:Password', 'urn:oasis:names:tc:SAML:2.0:ac:classes:X509'),
        'requestedAuthnContext' => true,
    ),

    // Contact information template, it is recommended to suply a technical and support contacts
    'contactPerson' => array(
        // 'technical' => array(
        //     'givenName' => 'name',
        //     'emailAddress' => 'no@reply.com'
        // ),
        'support' => array(
            'givenName' => 'Support',
            'emailAddress' => 'luanbhk@vng.com.vn'
        ),
    ),

    // Organization information template, the info in en_US lang is recomended, add more if required
    'organization' => array(
        'en-US' => array(
            'name' => 'E-Mail Address',
            'displayname' => 'The e-mail address of the user',
            'url' => 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/emailaddress'
        ),
        // 'en-US' => array(
        //     'name' => 'Given Name',
        //     'displayname' => 'The given name of the user',
        //     'url' => 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname'
        // ),
        // 'en-US' => array(
        //     'name' => 'Name',
        //     'displayname' => 'The unique name of the user',
        //     'url' => 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/name'
        // ),
    ),

    /* Interoperable SAML 2.0 Web Browser SSO Profile [saml2int]   http://saml2int.org/profile/current

   'authnRequestsSigned' => false,    // SP SHOULD NOT sign the <samlp:AuthnRequest>,
                                      // MUST NOT assume that the IdP validates the sign
    'wantAssertionsSigned' => true,
    'wantAssertionsEncrypted' => true, // MUST be enabled if SSL/HTTPs is disabled
    'wantNameIdEncrypted' => false,
*/

);
