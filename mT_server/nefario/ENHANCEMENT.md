Enhanced the ```mT_xxx``` perl and php scripts to allow running it from everywhere
as a server environment and to make it more portable.

Its now also possible to define the following environment variable to point to the ```mT_xxx``` script folder.

e.g.

```bash
MT_PROCESSOR_PATH=/opt/minoTour/mT_server/nefario
```

then you can run it with
```bash
export MT_PROCESSOR_PATH=/opt/minoTour/mT_server/nefario
$MT_PROCESSOR_PATH/mT_control.pl
```


