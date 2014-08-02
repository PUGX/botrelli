set :application, "botrelli"
set :domain,      "#{application}.pugx.org"
set :deploy_to,   "/var/www/botrelli"
set :app_path,    "app"

set :user,        "root"

default_run_options[:pty] = true
ssh_options[:forward_agent] = true

set :app_config_file, "parameters.yml"
## Repository

set :scm,         :git
set :branch, "master"
set :git_shallow_clone, 1
set :model_manager, "doctrine"
set  :keep_releases,  3
set  :use_sudo,       false
set :use_composer, true


set :repository,  "git@github.com:PUGX/botrelli.git"
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :model_manager, "doctrine"

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  3

logger.level = Logger::MAX_LEVEL

set :shared_files,      ["app/config/parameters.yml"]
