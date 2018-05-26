<?php

namespace App\Console\Commands;

use App\Providers\AppServiceProvider;

class IssueGetList extends GitlabCommandAbstract
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'issue:get-list {--P|project_id= : Project id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get issue list for specified project from Gitlab';

    protected function getEntityName(): string
    {
        return AppServiceProvider::ISSUE;
    }

    protected function getHeaders(): array
    {
        return [
            'id',
            'iid',
            'title',
            'gitlab_created_at',
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

        return [
            ':project_id' => $this->option('project_id'),
        ];
    }

}
