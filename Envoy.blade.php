@servers(['web' => ['bitnami@35.157.157.80']])

@setup
    $repository = 'git@github.com:Global-Group-Consulting/global-sso.git';
    $releases_dir = '/opt/bitnami/nginx/html';
    $app_dir = '/opt/bitnami/nginx/html/global-sso';
    $release = date('YmdHis');
    $new_release_dir = $releases_dir .'/'. $release;
@endsetup

@story('deploy')
    clone_repository
    run_composer
    update_symlinks
@endstory

@task('clone_repository')
    echo 'Cloning repository'
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
    cd {{ $new_release_dir }}
    git reset --hard {{ $commit }}
@endtask

@task('run_composer')
    echo "Starting deployment ({{ $release }})"
    cd {{ $new_release_dir }}
    composer install --prefer-dist --no-scripts -q -o
@endtask

@task('update_symlinks')
    echo "Linking storage directory - {{ $app_dir }}"
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $app_dir }}/storage {{ $new_release_dir }}/storage

    echo 'Linking .env file'
    ln -nfs {{ $app_dir }}/.env {{ $new_release_dir }}/.env

    echo 'Linking current release - {{ $new_release_dir }}'
    ln -nfs {{ $new_release_dir }} {{ $releases_dir }}/current

    {{-- php artisan storage:link --}}
@endtask
