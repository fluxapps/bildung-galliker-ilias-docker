# IQSoftEvent ILIAS Plugin

## Installation

Start at your ILIAS root directory. It is assumed the generated downloaded plugin `iqse.zip` is in your download folder `~/Downloads`. Otherwise please adjust the commands below

Run the follow commands:

```bash
mkdir -p Customizing/global/plugins
cd Customizing/global/plugins
mv ~/Downloads/iqse.zip iqse.zip
unzip iqse.zip
unlink iqse.zip
```

Update and activate the plugin in the ILIAS Plugin Administration

Look after `TODO`'s in the plugin code. May you can remove some files (For example config) depending on your use. Also override this initial Readme

## Requirements

* ILIAS 5.3.0 - 5.3.999
* PHP >=7.0
