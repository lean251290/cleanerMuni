#!/usr/bin/env python
# coding: utf-8
import re 
import sys

def return_id_telefono_tipo(phone):
    if(re.findall(r"(^44)", phone)):
        return 1
    else:
        return 3


if(len(sys.argv)>=2):
    phone_code = return_id_telefono_tipo(sys.argv[1])
    print(phone_code)
else:
    print("no procesado")




