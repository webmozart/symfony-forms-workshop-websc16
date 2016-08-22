#!/bin/bash

set -e

tags=(01-crud 02-value-objects 03-composite-value-objects 04-command-forms 05-html 06-split-input-output 07-references 08-code-reuse-form 09-code-reuse-html)
i=0

git checkout result
git rebase master

for commit in $(git log result~9.. --format=%h | tac); do
    git checkout ${commit}
    git tag -f ${tags[i]}
    i=$(($i + 1))
done

git checkout master
