# CI/CD
Architecture: GitLab CI/CD <--> GitLab Runner (writen in GO)

# Get Start

General Steps:

1. at local project dir: `.gitlab-ci.yml`(YAML file)
2. config in gitlab: use a `Runner`
3. push, and trigger `pipline`

runner has three default stages: build -> test -> deploy

`.gitlab-ci.yml` explained (see <https://docs.gitlab.com/ee/ci/yaml/README.html>)

```yaml
before_script: # run before every job
  - apt-get update -qq && apt-get install -y -qq sqlite3 libsqlite3-dev nodejs
  - ruby -v
  - which ruby
  - gem install bundler --no-document
  - bundle install --jobs $(nproc)  "${FLAGS[@]}"

rspec: # top-level element define a job name
  script: # job must have script
    - bundle exec rspec

rubocop:
  script:
    - bundle exec rubocop
```

config a runner (see <https://docs.gitlab.com/runner/>)