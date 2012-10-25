#!/bin/bash

echo "Suppression du cache i18n..."
rm -rf cache/gamersassembly/test/i18n/*
rm -rf cache/gamersassembly/dev/i18n/*
rm -rf cache/gamersassembly/prod/i18n/*
echo "OK"
