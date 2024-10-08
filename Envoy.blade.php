@servers(['web' => ['bitnami@35.157.157.80']])

@setup
    $repository = 'git@github.com:Global-Group-Consulting/global-iam.git';
    $releases_dir = '/opt/bitnami/nginx/html/global-iam';
    $app_dir = '/opt/bitnami/nginx/html/global-iam';
    $release = date('YmdHis');
    $new_release_dir = $releases_dir .'/'. $release;
    $branch = 'staging'
@endsetup

@story('deploy')
    clone_repository
    run_composer
    set_permissions
    update_symlinks
@endstory

@task('clone_repository')
    echo 'Cloning repository - git clone {{ $repository }} -b {{$branch}} {{ $new_release_dir }}'
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    git clone {{ $repository }} -b {{$branch}} {{ $new_release_dir }}
    cd {{ $new_release_dir }}
@endtask

@task('run_composer')
    echo "Starting deployment ({{ $release }})"
    cd {{ $new_release_dir }}
    composer install --prefer-dist --no-scripts -q -o
@endtask


@task('set_permissions')
    sudo chmod 777 -R {{$new_release_dir}}/storage/
    sudo chmod 777 -R {{$new_release_dir}}/bootstrap/
@endtask


@task('update_symlinks')
   {{-- echo "Linking storage directory - {{ $app_dir }}"
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $app_dir }}/storage {{ $new_release_dir }}/storage--}}

    echo 'Linking .env file'
    ln -nfs {{ $app_dir }}/.env {{ $new_release_dir }}/.env

    echo 'Linking current release - {{ $new_release_dir }}'
    ln -nfs {{ $new_release_dir }} {{ $releases_dir }}/current

    {{-- php artisan storage:link --}}
    cd {{ $new_release_dir }}

    echo 'restarting php-fpm'
    sudo /opt/bitnami/ctlscript.sh restart php-fpm
@endtask
