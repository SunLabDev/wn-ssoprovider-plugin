## SSO Provider
This plugin allows your website to act as an SSO Provider:
- It will issue keys to the SSO Clients websites to access your userbase.
- It will allow your users to login on the SSO Clients websites without creating an account.
> Note: This plugin is intended to be used with [this SSO Client](https://github.com/sunlabdev/wn-ssoclient-plugin)

### Composer installation
```terminal
composer require sunlab/wn-ssoprovider-plugin
```

### Components
This plugin provides two components:
- SSOLoginPopup: Displays the SSO authorization issuer and login form if the user is not yet logged-in
- SSOAuthorizedClients: Displays to the user the clients that granted the authorization
  and allow him to revoke an authorization
