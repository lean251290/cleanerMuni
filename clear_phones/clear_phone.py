#!/usr/bin/env python
import re
import sys


#Lista con todos los codigos de area de Argentina
prefix_list = ["11", "220", "2202", "221", "2221", "2223", "2224", "2225", "2226", "2227", "2229", "223", "2241", 
"2242", "2243", "2244","2245", "2246", "2252", "2254", "2255", "2257", "2261", "2262", "2264", "2265", "2266", "2267", 
"2268", "2271", "2272", "2273", "2274", "2281", "2283","2284", "2285", "2286", "2291", "2292", "2296", "2297", "230", 
"2302", "2314", "2316", "2317", "2320", "2323", "2324", "2325", "2326", "2331", "2333","2334", "2335", "2336", "2337", 
"2338", "2342", "2343", "2344", "2345", "2346", "2352", "2353", "2354", "2355", "2356", "2357", "2358", "236", "237", "2392",
"2393", "2394", "2395", "2396", "2473", "2474", "2475", "2477", "2478", "249", "260", "261", "2622", "2624", "2625", "2626", 
"263", "264", "2646", "2647","2648", "2651", "2655", "2656", "2657", "2658", "266", "280", "2901", "2902", "2903", "291", "2920", 
"2921", "2922", "2923", "2924", "2925", "2926", "2927","2928", "2929", "2931", "2932", "2933", "2934", "2935", "2936", "294", "2940", 
"2942", "2945", "2946", "2948", "2952", "2953", "2954", "2962", "2963", "2964", "2966", "297", "2972", "298", "2982", "2983", "299", 
"3327", "3329", "336", "3382", "3385", "3387", "3388", "3400", "3401", "3402", "3404", "3405", "3406", "3407", "3408", "3409", "341",
"342", "343", "3435", "3436", "3437", "3438", "3442", "3444", "3445", "3446", "3447", "345", "3454", "3455", "3456", "3458", "3460", "3462", "3463", "3464",
"3465", "3466", "3467", "3468", "3469", "3471", "3472", "3476", "348", "3482", "3483", "3487", "3489", "3491", "3492", "3493", "3496", "3497", "3498", "351",
"3521", "3522", "3524", "3525", "353", "3532", "3533", "3537", "3541", "3542", "3543", "3544", "3546", "3547", "3548", "3549", "3562", "3563", "3564", "3571",
"3572", "3573", "3574", "3575", "3576", "358", "3582", "3583", "3584", "3585", "362", "364", "370", "3711", "3715", "3716", "3718", "3721", "3725", "3731",
"3734", "3735", "3741", "3743", "3751", "3754", "3755", "3756", "3757", "3758", "376", "3772", "3773", "3774", "3775", "3777", "3781", "3782", "3786", "379",
"380", "381", "3821", "3825", "3826", "3827", "383", "3832", "3835", "3837", "3838", "3841", "3843", "3844", "3845", "3846", "385", "3854", "3855", "3856",
"3857", "3858", "3861", "3862", "3863", "3865", "3867", "3868", "3869", "387", "3873", "3876", "3877", "3878", "388", "3885", "3886", "3887", "3888", "3891",
"3892", "3894", "44"]

#FUNCIONES

#Funcion para verificar campos con espacios, caracteres especiales, etc
def wrong_phone(phone):
    if (re.findall(r"[\D+\s+]|(^54)|(^0+)", phone)):
        return True
    else:
        return False
    
#Verifica existencia del valor (54 o 0) al inicio de la cadena, en caso afirmativo elimina dicho valor
def clear_begin(phone):
    if(re.findall(r"(^54)", phone)):
        cadena_clean = re.sub(r"(54)", '', phone, 1)
    elif(re.findall(r"(^0)", phone)):
        cadena_clean = re.sub(r"(0)", '', phone, 1)
    else:
        cadena_clean = phone
    return cadena_clean

    
#Verifica si el telefono posee un valor = 15 luego del codigo de area, y en caso afirmativo eliminar dicho valor de la cadena
def clear_phone(phone):
    if(re.findall(r"(^\d{1,4})(15)(\d{6})", phone)) :
       phone_clean = re.sub("(15)", "", phone, 1)
       return phone_clean
    else:
       return phone

#Elimina todos los caracteres de un string dado
def clear_cell(value):
    value = re.sub(r".", '', value)
    return value

#Verifica caracteres repetidos, asi como tambien una longitud menor a la minima que debe tener un telefono
def repeat_characters(phone):
    if(re.findall(r"(00000)|(11111)|(22222)|(33333)|(44444)|(55555)|(66666)|(77777)|(88888)|(99999)", phone)):
        return True
    else:
        return False

def is_fijo(phone):
    if(re.findall(r"(^44)", phone)):
        return True
    else:
        return False

def process_fijo(phone):
    if(is_fijo(phone)):
        phone_f = phone

        if(repeat_characters(phone_f) or len(phone_f) < 7):
            phone_f = clear_cell(phone_f)

        return phone_f
    else:
        return phone

def clear_spaces(phone):
    phone = re.sub(r"\s+", '', phone)
    return phone

def clear_string(phone):
    phone = re.sub(r"\D+", '', phone)
    return phone

#vefifica existencia del comienzo del telefono en la lista de prefijos(cods. de area) definida previamente
def find_prefix(phone):
    if(phone[:2] in prefix_list or (phone[:3] in prefix_list) or (phone[:4] in prefix_list)):
        return True
    else:
        return False

def edit_begin(phone):
    if(re.findall(r"(^154)", phone)):
        phone = re.sub(r"(154)", "3794", phone)
    else:
        phone
    return phone

def delete_four(phone):
    if(re.findall(r"(^37944)", phone)):
        phone = re.sub(phone[4], '', phone, 1)
        return phone
    else:
        return phone





#funcion principal  
def validator_phone(phone):

    #limpia espacios
    phone = clear_spaces(phone)

    #elimina caracteres no numericos
    phone = clear_string(phone)

    #elimina comienzos erroneos (0, 54) si corresponde
    phone = clear_begin(phone)

    #reemplaza 154 por 3794 si corresponde
    phone = edit_begin(phone)

    if(len(phone) < 7):
        phone = clear_cell(phone)

    if(find_prefix(phone)):

        #si empieza con 37944, elimina el ultimo 4 de dicho valor
        phone = delete_four(phone)

        #verifica si es fijo y lo procesa
        phone = process_fijo(phone)

        #elimina el 15 despues del cod. area, si existiese
        phone = clear_phone(phone)

        if(repeat_characters(phone)):
            phone = clear_cell(phone)

        if( (len(phone) < 7) or (len(phone) == 8) or (len(phone) == 9) ):
            phone = clear_cell(phone)
            
        return phone
    else:
        return ''
    

if(len(sys.argv)>=2):
    phone_final = validator_phone(sys.argv[1])
    print(phone_final)
else:
    print("no procesado")




