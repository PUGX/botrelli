SELECT count(repository_url) as counta,payload_action
FROM [githubarchive:github.timeline]
WHERE payload_pull_request_head_repo_owner_login = "pborreli"
GROUP BY payload_action
order by counta DESC


counta |	payload_action
------ | ------
944	| opened
922	| closed
5 |	reopened
5 |	created
