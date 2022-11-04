//Name: Heiton Zang HXZ190015
//Date:9/29/2022
//Desc: frauddetect
//Prog: 1st input file name, output ids

#include <stdio.h>
#include <iostream>
#include <stdio.h>
#include <fstream>
#include <stdlib.h>
#include <sstream>
#include <string> 
#include <list>

using namespace std;

struct Transaction {
    public:
    Transaction(int cust, int trans, int date, double a, double lon, double lat) {
        custID = cust; transID = trans; dateTime = date;
        a = amt; longitude = lon; latitude = lat;
    }
    bool operator <(const Transaction & transObj) const {
        if(custID == transObj.custID)
            return dateTime < transObj.dateTime;
        return custID < transObj.custID;
    }
    int custID, transID,dateTime;
    double amt, longitude, latitude;
    
};

int main(int argc, char **argv) 
{
    string filename = argv[1];
    string line;
    ifstream file1;
    list<Transaction> transList;
    int custID, transID,dateTime;
    double amt, longitude, latitude;
    file1.open(filename);

    while(getline(file1,line)) { //create sorted list of entries
        stringstream s(line);
        string field;
        while (getline(s, field,',')) {
            s >> custID; s>>transID; s>>dateTime;
            s >>amt; s>> longitude; s>> latitude;
            Transaction temp = Transaction(custID,transID,dateTime,amt,longitude,latitude);
            transList.push_back(temp);
        }
    }
    transList.sort();
    file1.close();
    
    int transAmt = 0; dateTime = 0;
    custID = -1;
    list<Transaction> sameCustList;
    int fraudType;
    ofstream output;
    //output.open("output.csv");
    //output << argv[3] << "\n";
    for(const auto& transTrav : transList) {
        if(custID != transTrav.custID) {
            if(custID != -1) {
                for(Transaction i: sameCustList) {
                    if(i.amt >= 200) {
                        fraudType+=2;
                    }
                    if(dateTime - i.dateTime < 20) {
                        fraudType+=1;
                    }
                    if(i.latitude / latitude < .5 || i.latitude / latitude > 1.5) {
                        fraudType+=4;
                    } else if(i.longitude / longitude < .5 || i.longitude / longitude > 1.5) {
                        fraudType+=4;
                    }
                    //output << i.custID << ", " << i.transID << ", " << i.dateTime << ", " <<
                    //to_string((bool)(fraudType!=0)) << ", " << to_string(fraudType) << "\n";
                    cout << i.custID << ", " << i.transID << ", " << i.dateTime << ", " <<
                    to_string((bool)(fraudType!=0)) << ", " << to_string(fraudType) << "\n";
                    fraudType = 0;
                }
                transAmt =0; dateTime=0;
                custID = transTrav.custID;
                sameCustList.clear();
            }
            custID = transTrav.custID;
            longitude = transTrav.longitude;
            latitude = transTrav.latitude;
        }
        else {
            sameCustList.push_back(transTrav);
            longitude = (longitude + transTrav.longitude)/2;
            latitude = (latitude + transTrav.latitude)/2;
            transAmt++;
        }
    }
    cout << "done";
}