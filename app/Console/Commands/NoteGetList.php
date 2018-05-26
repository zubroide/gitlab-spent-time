<?php

namespace App\Console\Commands;

use App\Providers\AppServiceProvider;

class NoteGetList extends GitlabCommandAbstract
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'note:get-list {--P|project_id= : Project id} {--I|issue_id= : Issue id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get comments for specified project issue from Gitlab';

    protected function getEntityName(): string
    {
        return AppServiceProvider::NOTE;
    }


    protected function getHeaders(): array
    {
        return [
            'id',
            'body',
            'author_id',
        ];
    }

    /**
     * @return array
     * @throws \Exception
     */
    protected function getUrlParameters(): array
    {
        if (!$this->option('project_id'))
        {
            throw new \Exception('project_id must be specified');
        }

        if (!$this->option('issue_id'))
        {
            throw new \Exception('issue_id must be specified');
        }

        return [
            ':project_id' => $this->option('project_id'),
            ':issue_id' => $this->option('issue_id'),
        ];
    }

}
