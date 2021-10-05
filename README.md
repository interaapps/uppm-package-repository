# UPPM-Package-Repository
## API
default {base_url} = https://central.uppm.interaapps.de
### Get all Organisations
```shell
GET {base_url}/
{
  "id": 1,
    "name": "interaapps",
    "created_at": "2021-10-05 20:21:12",
    "packages": PACKAGE[]
  }
]
```

### Get Organisation `(ORGANISATION)`
```shell
GET {base_url}/{organisation}
{
  "id": 1,
    "name": "interaapps",
    "created_at": "2021-10-05 20:21:12",
    "packages": PACKAGE[]
  }
]
```
### Get Package `(PACKAGE)`
```shell
GET {base_url}/{organisation}/{package_name}
{
  "id": 1,
    "organisation_id": 1,
    "name": "jsonplus",
    "github": "interaapps/JSONPlus",
    "created_at": "2021-10-05 20:21:52",
    "versions": PACKAGE_VERSION[]
}
```
### Get Package Version `(PACKAGE_VERSION)`
You can use `@lastest` as {package_name} if you want to get the latest package version.
```shell
GET {base_url}/{organisation}/{package_name}
{
    "id": 1,
    "package_id": 1,
    "name": "1.0.0",
    "download_url": "https://github.com/interaapps/JSONPlus/archive/refs/tags/1.0.0.zip",
    "created_at": "2021-10-05 20:22:46"
}
```

## Planned:
- Login with IA-Accounts
- Upload vvia API